<?php

namespace App\Http\Controllers;

use App\Models\ReportDate;
use App\Models\ReportItem;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportItemController extends Controller
{
    //
    function index(Request $request)
    {
        $now = Carbon::now();
        $report = ReportDate::where('id', $request->report_date_id)->first();
        if (!$report) {
            abort(404, 'No Report Found.');
        }

        if (Auth::user()->user_type != 'Admin') {
            if (Auth::user()->id != $report->user_id) {
                if (!$report) {
                    abort(401, 'You Are Not Authorized to View This Report.');
                }
            }
        }

        $editable = false;
        if (Auth::user()->user_type == 'Operator') {
            if ($now->format('Y-m-d') == $report->report_date) {
                $editable = true;
            }
        } else {
            $editable = true;
        }


        $reportItems = ReportItem::where('report_date_id', $request->report_date_id)->orderBy('id', 'DESC')->get();
        $reportDate = new Carbon($report->report_date);
        

        return view('show-all-items', [
            'report' => $report,
            'reportItems' => $reportItems,
            'editable' => $editable,
            'reportDate' => $reportDate
        ]);


    }

    public function storeReportItem(Request $request)
    {
        // validations
        $reportItem = new ReportItem();
        $reportItem->report_date_id = $request->report_date_id;
        $reportItem->content = $request->content;
        $reportItem->user_id = $request->user_id;
        $reportItem->created_by = Auth::user()->id;
        $reportItem->save();
        return redirect()->back();
    }

    public function deleteReportItem(Request $request)
    {
        // validations
        ReportItem::findOrFail($request->report_item_id)->delete();
        return redirect()->back();
    }

}