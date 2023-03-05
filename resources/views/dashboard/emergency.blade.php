@extends('dashboard.sidebar')

@section('content')
<div class="userappoint">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <hr style="height: 60px">
                <h3>Emergency Name :{{ $username }}
            </h3>
                <form action="{{ route('emergencyAppoint') }}" method="POST" >
                    @csrf
                    @method('POST')

                    <div class="row">
                            <input value="{{ $username }}" type="text" name="username" style="display: none">
                            <input value="{{ $username }}@emer.com" type="email" name="email" style="display: none">
                            <input value="1" type="password" name="password" style="display: none">
                            <input value="01000000000" type="tel" name="phone" style="display: none">
                            <input type="date" name="appoint-date" class="emergDate" style="display: none">
                            <input type="time-local" name="appoint-time" class="emergTime" style="display: none">
                    </div>
                    <div class="row">
                        <h4>Department Details</h4>
                            <select class="form-control" id="book-department-option" name="department" autocomplete="department" required>
                                <option value="" selected>Select Department</option>
                                @foreach ($departments as $department )
                                <option value="{{ $department['id'] }}">
                                {{ $department['department_name'] }}</option>
                                @endforeach
                            </select>

                            <select class="form-control" id="book-doctor-option" name="doctor" autocomplete="doctor" required>
                            </select>
                        <input type="submit" class="btn btn-primary" value="Book Emergency Appointment">
                    </div>
                </form>
                <form action="{{ route('storeUserAppoint') }}" method="POST">
                    <br>
                    @csrf
                    @method('POST')

                    <div class="row">
                            <input type="hidden" name="user_id" >
                            <input value="@php echo $username ; @endphp" type="text" name="name" style="display: none">
                            <input value="emer@emer.com" type="email" name="email" style="display: none">
                            <input value="01000000000" type="tel" name="phone" style="display: none">
                            <input type="date" name="appoint-date" class="emergDate" style="display: none">
                            <input type="time-local" name="appoint-time" class="emergTime" style="display: none">
                    </div>
                    <div class="row">
                        <h4>Department</h4>
                            <select class="form-control" id="make-department-option" name="department" autocomplete="department" required>
                                <option value="" selected>Select Department</option>
                                @foreach ($departments as $department )
                                <option value="{{ $department['id'] }}">
                                {{ $department['department_name'] }}</option>
                                @endforeach
                            </select>
                            <select class="form-control" id="make-doctor-option" name="doctor" autocomplete="doctor" required>
                            </select>
                        <input type="submit" class="btn btn-primary" value="Make Emergency Appointment">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
