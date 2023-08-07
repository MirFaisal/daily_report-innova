<?php

namespace App\Http\Controllers;

use App\Models\ReportDate;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportDateController extends Controller
{
    //
    function index()
    {
        $reportDate = ReportDate::orderBy('report_date', 'desc')->simplePaginate(15);
        $currentUserReportDate = ReportDate::where('user_id', Auth::user()->id)->orderBy('report_date', 'desc')->simplePaginate(15);
        // dd($currentUserReportDate);
        return view('welcome', compact(['reportDate', 'currentUserReportDate']));
    }
    function store(Request $request)
    {

        // dd($request->all());
        $reportDate = new ReportDate();
        $reportDate->report_date = $request->report_date;
        $reportDate->user_id = auth()->user()->id;
        $reportDate->created_by = auth()->user()->id;
        $reportDate->save();

        $reportDateID = $reportDate->id;

        return redirect()->route('report.item.create', $reportDateID);
    }
    function createReport()
    {
        $operators = User::where('user_type', 'Operator')->orderBy('name', 'ASC')->get();
        return view('create-report', ['operators' => $operators]);
    }

    function storeReport(Request $request)
    {
        $now = Carbon::now();
        if (Auth::user()->user_type == 'Admin') {
            if (!empty($request->ADM_REPORT_DATE)) {
                if ($request->ADM_USER_ID != 'NO_USER') {
                    $userId = $request->ADM_USER_ID;
                    $reportDate = $request->ADM_REPORT_DATE;
                } else {
                    return redirect()->back()->with('error', 'Select User.');
                }
            } else {
                return redirect()->back()->with('error', 'Select Date.');
            }



        } else {
            $userId = Auth::user()->id;
            $reportDate = $now->format('Y-m-d');
        }
        // check existence
        $report = ReportDate::where('user_id', $userId)->where('report_date', $reportDate)->first();



        if (!$report) {
            $newReport = new ReportDate();
            $newReport->user_id = $userId;
            $newReport->created_by = Auth::user()->id;
            $newReport->report_date = $reportDate;
            $newReport->save();
            $rdrURL = route('REPORT_ITEM::CREATE::VIEW', $newReport->id);
            return redirect()->to($rdrURL);
        }

        return redirect()->back()->with('error', 'Report Already Exists.');

    }
    function search()
    {
        $currentUserId = auth()->user()->id;

        if (auth()->user()->user_type == 'Admin') {
            $operators = User::where('user_type', '!=', 'Admin')->get();
            // $operators = User::all();
            return view('search', compact(['operators']));
        }
        // dd('false');
        $operators = User::where('id', $currentUserId)->get();
        // dd($operators);

        return view('search', compact(['operators']));



    }
    function result(Request $request)
    {

        if (auth()->user()->user_type = 'Admin') {
            $report = ReportDate::where('user_id', $request->operator)->get();
            $reports = $report->whereBetween('report_date', [$request->from, $request->to]);
        }
        dd($reports);

        $from = $request->from;
        $to = $request->to;

        return view('results', compact(['reports', 'from', 'to',]));
    }

}