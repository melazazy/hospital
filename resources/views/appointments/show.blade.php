@extends('layouts.app')

@section('content')
<div class="container">
    <div class="top-row mb-4">
        <div>Appointments For <span class="text-primary" > {{ $department }} </span>Department
        </div >
        <div><a href="{{ route('userappointment')}}" class="btn btn-primary ">make appointment</a>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped table-hover table-responsive">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Doctor_id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Booked</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment )
                <tr>
                    <th scope="row">
                        <a href="{{ route('profile',  $appointment['doctor_id'])}} ">
                        {{ $appointment->doctor->user_detail->full_name}}
                        </a>
                    </th>
                    <th scope="row">{{ $appointment['appoint_date'] }}</th>
                    <td>{{ $appointment['appoint_time'] }}</td>
                    <th scope="row text-left">
                        @if ($appointment['is_token'] == 0 && Auth::user() && Auth::user()->type == 'patient')
                        <form action="{{ route('appointments.update',$appointment['id'] )}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="patient_id" value="{{ Auth::user()->id }}">
                            <input class="btn btn-primary w-auto" type="submit" value="Book Now">
                        </form>
                        @else
                        Only patient User Can Book an Appointment
                        @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
