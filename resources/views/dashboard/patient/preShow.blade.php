@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h2 class="text-center"><img src="{{ asset('storage//images/hospital.png') }}" alt="h" width="{{ 40 }}"> E-Hospital</h2>
        <h4 class="text-center">Dr. {{ $prescription->appoint->doctor->user_detail['full_name'] }}</h4>
        <div class="pre--data">
            <p>
                751 Victoria 123 Street, South Statue 204
            </p>
            <p>
                Hometown, US 1234
            </p>
            <p>
                PH: (207) 808 2014 2014
            </p>
            <p>
                FAX: (207) 808 2015 2202
            </p>

        </div>
        <div class="pre--details">
            <p>
                Patient Name : {{ $prescription->appoint->patient->user_detail['full_name'] }}
            </p>
            <p>
                Gender : {{ $prescription->appoint->patient->user_detail['gender'] }}
            </p>
            <p>
                Date : {{ $prescription->appoint['appoint_date'] }}
            </p>
        </div>
        <div class="pre">
            <h1>Rx</h1>
            <ul>
                @forelse ( $pres as $med)
                    <li>{{ $med }}</li>
                @empty
                    No
                @endforelse
            </ul>
        </div>
        <div class="footer">
            Doctor's Signature: <i>{{ $prescription->appoint->doctor->user_detail['full_name'] }}</i>
        </div>
        <div class="row d-print-none">
            <div class="col-11">
                <button class="col-4 btn btn-primary float-end " onClick="window.print()">Print</button>
            </div>
        </div>
    </div>
</div>

@endsection


