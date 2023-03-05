@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">

        {{-- display appointment --}}
        <table class="table table-striped table-hover table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Patient name</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment )
                <tr>
                    <td scope="row">{{ $appointment['appoint_date'] }}</td>
                    <td>{{ $appointment['appoint_time'] }}</td>
                    <td> {{ $appointment->patient->user_detail['full_name'] ?? 'Patient Name' }} </td>
                    <td> <a href="{{ route('diagnosis',['type'=>'doc','id'=>$appointment['id']]) }}">Process</a>  </td>
                    <td>
                        <form action="{{ route('appointments.destroy',$appointment['id'] )}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn" type="submit" value="Cancle">
                        </form>
                    </td>
                </tr>
                @endforeach
                @foreach ($userAppointments as $userAppointment )
                <tr>
                    <td scope="row">{{ $userAppointment['appoint-date'] }}</td>
                    <td>{{ $userAppointment['appoint-time'] }}</td>
                    <td> {{ $userAppointment->patient->user_detail['full_name'] ?? 'Patient Name' }} </td>
                    <td> <a href="{{ route('diagnosis',['type'=>'user','id'=>$userAppointment['id']]) }}">Process</a>  </td>
                    <td>
                        <form action="{{ route('appointments.destroy',$userAppointment['id'] )}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn" type="submit" value="Cancle">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
