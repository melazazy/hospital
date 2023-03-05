@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">
        <table class="table table-striped table-hover table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col">Appoint_ID</th>
                    <th scope="col">Patient name</th>
                    <th scope="col">Prescription</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $pres as $pre )
                <tr>
                    <td scope="row"> {{ $pre['appoint_id'] }} </td>
                    <td> {{ $pre->appoint->patient->user_detail['full_name']  }} </td>
                    <td> <a href="{{ route('prescriptions.show',[$pre['id']]) }}">{{ $pre['prescription'] }}</a></td>
                </tr>
                @empty
                <tr><td colspan="3"> <h3>No Prescription Yet</h3> </td></tr>
                @endforelse
            </tbody>
        </div>
    </div>
</div>
@endsection
