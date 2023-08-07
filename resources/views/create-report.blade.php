@extends('layouts.master') @section('content')
<?php $showToday =  \Carbon\Carbon::now()->format('M d, Y') ?>
<div class="w-50 mx-auto p-5 border">
    @if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get("error") }}
    </div>
    @endif
    <form action="{{ route('REPORT::CREATE::ACTION') }}" method="post">
        @csrf @if(auth()->user()->user_type == 'Admin')
        <div class="mt-2">
            <h3>Select Date</h3>
            <input type="date" name="ADM_REPORT_DATE" class="form-control" />
        </div>
        <div class="mt-4">
            <h3>Select Member</h3>
            <select name="ADM_USER_ID" class="form-select">
                <option value="NO_USER">User List</option>
                @foreach($operators as $operator)
                <option value="{{$operator->id}}">{{$operator->name}}</option>
                @endforeach
            </select>
        </div>
        @else
        <div>
            <h3>{{ $showToday }}</h3>
        </div>
        @endif
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-primary mt-3" type="submit">Initiate</button>
        </div>
    </form>
</div>

@endsection
