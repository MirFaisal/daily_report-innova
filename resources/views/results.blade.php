@extends('layouts.master') @section('content')
<div class="w-50 mx-auto p-5 border">
    <div class="mt-5">
        <div class="mt-5">
            <div>
                <h2 class="text-center mb-2">Reports</h2>
                <div class="d-flex justify-content-center w-50 mx-auto gap-3">
                    <p>{{ $from }}</p>
                    <p>to</p>
                    <p>{{ $to }}</p>
                </div>
            </div>
            @if(!empty($reports))
            <div class="mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">date</th>
                            <th scope="col">
                                <div class="d-flex justify-content-end">
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $key => $report)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{$report->createBy($report->user_id)}}</td>
                            <td>
                                {{$report->created_at->format('j F, Y')}}
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
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
