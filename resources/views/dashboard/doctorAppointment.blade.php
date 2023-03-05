
@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">
        @if(!empty($msg))
            @if (Str::startsWith($msg, 'Error'))
            <div class="alert alert-danger"> {{ $msg }} </div>
            @else
            <div class="alert alert-success"> {{ $msg }} </div>
            @endif
        @endif
        <div class="row appointmentForm">
            <form id="appointmentForm" action="{{ route('appointments.store') }}" method="post" >
                @csrf
                @method('POST')
                <input type="hidden" name="doctorId" value="{{ Auth::user()->id }}" id="doctorId">
                <input type="hidden" name="departmentId" value="{{ Auth::user()->user_detail['department_id'] }}" id="departmentId">

                <div class="form-group">
                    <label for="appoint_date">Date</label>
                    <input type="date" name="appoint_date" id="appoint_date">
                </div>
                <div class="form-group">
                    <label for="appoint_time">Time</label>
                    <input type="time" name="appoint_time" id="appoint_time">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-o btn-primary" value="Schedule">
                </div>
            </form>
        </div>
        @if($appoint_req->count()>0)
        <hr>
        <h3>Requested Appointments</h3>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Patient</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Management</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appoint_req as $req )
                <tr>
                    <th scope="row">{{ $req['appoint-date'] }}</th>
                    <td>{{ $req['appoint-time'] }}</td>
                    @if ($req['accepted'] == 0)
                        <td> Not Approval </td>
                    @else
                        <td> Approval </td>
                    @endif
                    <td><a href="{{ route('profile',[$req->patient->id]) }}">{{ $req->patient->user_detail['full_name'] }}</a> </td>
                    @if ($req['accepted'] == 0)
                    <td>{{ $req['notes'] }}</td>
                    <th>
                        <span>
                            <form class="d-inline" action="{{ route('updateUserAppoint',$req['id'] )}}" method="post">
                                @csrf
                                <input type="hidden" name="update" value="0">
                                <button type="submit"><i class='bx bx-x delete-i-Btn'></i></button>
                            </form>
                        </span>
                        <span>
                            <form class="d-inline" action="{{ route('updateUserAppoint',$req['id'] )}}" method="post">
                            @csrf
                            <input type="hidden" name="update" value="1">
                                <button type="submit"><i class='bx bx-check-double edit-i-Btn'></i></button>
                            </form>
                        </span>
                    </th>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <hr>

        <h3>My Appointments</h3>
        {{-- display appointment --}}
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Patient</th>
                    <th scope="col">Management</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment )
                <tr>
                    <th scope="row">{{ $appointment['appoint_date'] }}</th>
                    <td>{{ $appointment['appoint_time'] }}</td>
                    @if ($appointment['is_token'] == 0)
                        <td> Not Booked </td>
                    @else
                        <td><a href="{{ route('profile',[$appointment->patient->id]) }}"> {{ ($appointment->patient->user_detail['full_name']) ?? 'Patient name' }} </a> </td>
                    @endif
                    <td>
                        @if ($appointment['is_token'] == 0)
                            <form action="{{route('appointments.destroy',$appointment['id'] )}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary" style="width: 178px" ><i class='bx bx-x delete-i-Btn'></i></button>
                        </form>
                        @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#d{{ $appointment['id'] }}">Cancle & message</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- end data --}}
    </div>
</div>

@endsection
@forelse ( $appointments as $appointment )
@if ($appointment['is_token'] != 0)
<div class="modal fade" id="d{{ $appointment['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cancle Appointment And Send a Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('cancleAppoint') }}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="from" value="{{ Auth::user()->id }}">
            <input type="hidden" name="appoint_id" value="{{ $appointment['id'] }}">
            <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send message</button>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
@endif
@empty

@endforelse

