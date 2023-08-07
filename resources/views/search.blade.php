@extends('layouts.master') @section('content')
<div class="w-50 mx-auto border p-5">
    <form action="{{ route('SEARCH::ACTION') }}" method="post">
        @csrf
        <h3 class="mb-2">Operator Name</h3>
        <div
            class="w-100 d-flex justify-content-between gap-3 align-items-center"
        >
            <div class="w-50">
                <select class="js-example-basic-single w-100" name="operator">
                    @foreach($operators as $operator)
                    <option value="{{$operator->id}}">
                        {{$operator->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="w-50 d-flex align-items-center gap-2">
                <input name="from" type="date" class="form-control" />
                <p>to</p>
                <input name="to" type="date" class="form-control" />
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-info text-white">
                Search
            </button>
        </div>
    </form>
</div>
@endsection
