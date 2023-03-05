@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">
        <br>
        <form action="{{ route('prescriptions.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="">
                <div class="col-lg-12">
                    <button id="add" type="button" class="form-control btn btn-success"><i class='bx bx-folder-plus'></i> Add Medicine</button>
                    <div id="newinput"></div>
                </div>
            </div>
            <ul id="searchResult"></ul>

            <div class="clear"></div>
            <input type="hidden" name="appoint_id" value="{{ $appoint['id'] }}">
            <div class="form-group">
            <textarea name="prescription" id="prescription" cols="90" rows="10" style="padding: 10px">Notes </textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Set Prescription & Process">
            </div>
        </form>
    </div>
</div>
@endsection
