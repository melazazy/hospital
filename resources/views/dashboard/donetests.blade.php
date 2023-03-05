@extends('dashboard.sidebar')

@section('content')
<hr style="height: 70px">
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<h3 class="text-center">Upload tests</h3>
<div class="container">
    <form action="{{ route('updateTest',$id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        @foreach ($tests as $test )
            <div class="mb-3">
                <label for="{{ $test }}" class="form-label">{{ $test }}</label>
                <input class="form-control" type="file" id="{{ $test }}" name="{{ $test }}" title="Upload {{ $test }} test Here..." accept=".pdf">
                <div class="form-group">
                    <label for="charge">Charge</label>
                    <input type="number" name="test_charge[]" class="charges">
                </div>
            </div>
        @endforeach
        <div class="form-group">
            <label for="charge">Total Charge</label>
            <input type="number" name="total_charge" id="total_charge" value="">
        </div>
        <input type="submit" value="Submit">
</form>
</div>
@endsection
