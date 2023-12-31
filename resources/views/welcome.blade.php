@extends('layouts.master')
<?php $userName = auth()->user()->name; ?> @section('PageTitle')
{{auth()->user()->user_type == 'Admin' ? 'All Reports' : "$userName's Daily Reports..."  }}
@endsection @section('content')
<div class="w-50 mx-auto p-5 border">
    <div class="d-flex pb-2 justify-content-between border-bottom">
        <h3>
            <?php $userName = auth()->user()->name; ?>
            {{auth()->user()->user_type == 'Admin' ? 'All Reports' : "$userName's Daily Reports..."  }}
        </h3>
        <a class="btn btn-primary" href="{{ route('REPORT::CREATE::VIEW') }}">
            <?php $today =  \Carbon\Carbon::now()->format('M d, Y') ?>
            {{auth()->user()->user_type == 'Admin' ? 'Make Report for Someone' : "Make Report $today" }}
        </a>
    </div>
    <div class="mt-5">
        <div class="mt-5">
            @if(!empty($currentUserReportDate) || !empty($reportDate))

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">
                            <div class="d-flex justify-content-end">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(Auth()->user()->user_type == 'Admin')
                    @foreach($reportDate as $key => $report)
                    <?php $carbonDate = \Carbon\Carbon::parse($report->report_date);
                    ?>
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            {{ $carbonDate->format('l') }} -
                            {{ $carbonDate->format('M d, Y') }}
                        </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <a
                                    href="{{route('REPORT_ITEM::CREATE::VIEW',$report->id)}}"
                                    class="btn btn-sm btn-info text-white"
                                    href=""
                                    >View</a
                                >
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <div></div>
                    @else @foreach($currentUserReportDate as $key => $report)
                    <?php $carbonDate = \Carbon\Carbon::parse($report->report_date);
                    ?>
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            {{ $carbonDate->format('l') }} -
                            {{ $carbonDate->format('M d, Y') }}
                        </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <a
                                    href="{{route('REPORT_ITEM::CREATE::VIEW',$report->id)}}"
                                    class="btn btn-sm btn-info text-white"
                                    href=""
                                    >View</a
                                >
                            </div>
                        </td>
                    </tr>
                    @endforeach @endif
                </tbody>
            </table>
            {{$reportDate->links()}}
            @else
            <div class="alert alert-warning" role="alert">No report added.</div>
            @endif
        </div>
    </div>
</div>
@endsection
