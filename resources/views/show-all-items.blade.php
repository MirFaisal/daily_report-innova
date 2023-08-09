@extends('layouts.master') @section('content')
<div class="w-50 mx-auto border p-5">
    <h3>REPORT</h3>
    <div class="mt-5" style="font-size: 20px">
        <p><b>Date:</b> {{$reportDate->format('M d, Y')}}</p>
        <p><b>Name:</b> {{$report->user->name}}</p>
    </div>
    <div class="mt-5" style="font-size: 20px">
        <h4>Tasks</h4>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    @if($editable)
                    <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($editable)
                <tr>
                    <form
                        action="{{ route('REPORT_ITEM::CREATE::ACTION') }}"
                        method="POST"
                    >
                        @csrf
                        <input
                            type="hidden"
                            name="report_date_id"
                            value="{{$report->id}}"
                        />
                        <input
                            type="hidden"
                            name="user_id"
                            value="{{$report->user_id}}"
                        />
                        <th scope="row">#</th>
                        <td>
                            <textarea
                                id="mytextarea"
                                type="text"
                                name="content"
                                class="form-control"
                            ></textarea>
                        </td>
                        <td>
                            <button class="btn btn-success">+</button>
                        </td>
                    </form>
                </tr>

                @endif
                <?php $totalReportItems = count($reportItems); ?>
                @foreach($reportItems as $key => $reportItem)
                <tr>
                    <th scope="row">{{ $totalReportItems - $key }}</th>
                    <td>{!!html_entity_decode($reportItem->content)!!}</td>
                    @if($editable)
                    <td>
                        <a
                            class="btn btn-danger"
                            href="{{route('REPORT_ITEM::DELETE::ACTION', $reportItem->id)}}"
                            >-</a
                        >
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
