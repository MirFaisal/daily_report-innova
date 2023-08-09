@extends('layouts.master') @section('PageTitle') {{ $user->name }} Reports from
{{ $from }} to {{ $to }}
@endsection @section('content')
<div class="w-50 mx-auto p-5 border">
    <div class="mt-5">
        <div class="mt-5">
            <div>
                <h2 class="text-center mb-2">{{ $user->name }} Reports</h2>
                <div class="d-flex justify-content-center w-50 mx-auto gap-3">
                    <h4>{{ $from }}</h4>
                    <p>to</p>
                    <h4>{{ $to }}</h4>
                </div>
            </div>
            @if(!empty($reports)) @foreach($reports as $key => $report)
            <?php $carbonDate = \Carbon\Carbon::parse($report->report_date); ?>
            <div
                class="mt-3 mb-3"
                style="border: 1px solid rgb(199, 199, 199); padding: 15px"
            >
                <h3 class="mb-3">
                    <i
                        >{{ $carbonDate->format('l') }} -
                        {{ $carbonDate->format('M d, Y') }}
                    </i>
                </h3>
                @foreach($report->reportItems as $key => $reportItem)
                <h5 style="margin-left: 20px">
                    {{ $key + 1 }}.
                    {!!html_entity_decode($reportItem->content)!!}
                </h5>
                @endforeach
            </div>
            @endforeach @endif
        </div>
    </div>
</div>
@endsection
