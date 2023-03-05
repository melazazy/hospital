@extends('dashboard.sidebar')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <hr style="height: 60px">
            <h3>  Book Appointment</h3>
            <form action="{{ route('appointments.update',['1']) }}" method="POST" >
            @csrf
            @method('PUT')
                <div class="input-group input-group-icon">
                <select class="form-control" id="patient_id" name="patient_id" autocomplete="patient" required>
                    <option value="" selected>Select patient</option>
                    @foreach ($patients as $patient )
                    <option value="{{ $patient['id'] }}">
                    {{ $patient['username'] }} | {{ $patient->user_detail['full_name'] }}
                </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-icon">
                <select class="form-control" id="book-department-option" name="department" autocomplete="department" required>
                    <option value="" selected>Select Department</option>
                    @foreach ($departments as $department )
                    <option value="{{ $department['id'] }}">
                    {{ $department['department_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-icon">
                <select class="form-control" id="book-doctor-option" name="appoint_id" autocomplete="doctor" required>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Book Now">
            </form>
        </div>
    </div>
</div>

@endsection
