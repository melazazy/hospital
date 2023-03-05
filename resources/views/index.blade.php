@extends('layouts.app')

@section('content')
<div class="home">
    <div class="overlay"></div>
    <div class="text">
        <div class="cont">
            @if(session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
            @endif

            <h2>Making Health Care Better Together</h2>
            <p>The Leading Hospital Management System Manage Appointments, Bills, Doctors, Payments and Patient Data with Ease!
                <br>
            </p>
            Check Available <a class="btn btn-primary" href="{{ URL('appointments/') }}"> Appointment <span class="arrow"> &rarr;</span> </a>
        </div>
    </div>
</div>
@endsection
