@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h3>My Booked Appointments</h3>
        {{-- display appointment --}}
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Doctor</th>
                    <th class="text-center" scope="col">Management</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment )
                <tr>
                    <th scope="row">{{ $appointment['appoint_date'] }}</th>
                    <td>{{ $appointment['appoint_time'] }}</td>
                    <td><a href="{{ route('profile',[$appointment->doctor->id]) }}"> {{ ($appointment->doctor->user_detail['full_name']) ?? 'Doctor name' }} </a> </td>
                    <td class="text-center">
                        @if ($appointment['done'] == 1)
                        <a class="btn btn-primary" href="{{ route('patientprescription') }}">Prescription</a>
                        <a class="btn btn-primary" href="{{ route('tests') }}">Tests</a>
                        <a class="btn btn-primary" href="{{ route('diagnosing',[$appointment['id']]) }}">Diagnosis</a>
                        @else
                        <a class="btn btn-danger" href="{{ route('cancelAppoint',[$appointment['id']]) }}">Cancel Appointment</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr style="margin: 30px 0 30px 0">
        <h3>My Requested Appointments</h3>
        {{-- display appointment --}}
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Management</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reqappoints as $appointment )
                <tr>
                    <th scope="row">{{ $appointment['appoint-date'] }}</th>
                    <td>{{ $appointment['appoint-time'] }}</td>
                    <td><a href="{{ route('profile',[$appointment->doctor->id]) }}"> {{ ($appointment->doctor->user_detail['full_name']) ?? 'Doctor name' }} </a> </td>
                    <td>
                        @if ($appointment['done'] == 1)
                        <a class="btn btn-primary" href="#">Prescription</a>
                        <a class="btn btn-primary" href="#WEf">Tests</a>
                        @else
                        <a class="btn btn-danger" href="{{ route('deleteOwnAppoint',[$appointment['id']]) }}">Cancel Appointment</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


