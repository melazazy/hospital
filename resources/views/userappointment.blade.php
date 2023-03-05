@extends('layouts.app')

@section('content')
<div class="userappoint">
    <div class="container">
    <form action="{{ route('storeUserAppoint') }}" method="POST" >
        @csrf
        @method('POST')
        <div class="row">
        <h4>Make Appointment</h4>
        <input type="hidden" name="user_id"
        @if ($user)
            @if ($user->id)
            value="{{ $user->id}}"
            @endif
        @else
        value="NULL"
        @endif
        >
        <div class="input-group input-group-icon">
            <input type="text" name="full_name"
            @if ($user)
                @if ($user->user_detail->full_name)
                value="{{ $user->user_detail->full_name }}"
                @else
                placeholder="Full Name"
                @endif
            @else
            placeholder="Full Name"
            @endif
            >
            <div class="input-icon"><i class="fa fa-user"></i></div>
        </div>
        <div class="input-group input-group-icon">
            <input type="email" name="email"
            @if ($user)
                @if ($user->email)
                value="{{ $user->email}}"
                @else
                placeholder="Email Adress""
                @endif
            @else
            placeholder="Email Adress"
            @endif
            >
            <div class="input-icon"><i class="fa fa-envelope"></i></div>
        </div>
        <div class="input-group input-group-icon">
            <input type="tel" name="phone"
            @if ($user)
                @if ($user->user_detail->phone)
                value="{{ $user->user_detail->phone}}"
                @else
                placeholder="Phone"
                @endif
            @else
            placeholder="Phone"
            @endif
            >
            <div class="input-icon"><i class="fa-solid fa-mobile-retro"></i></div>
        </div>
        </div>
        <div class="row">
        <div class="col-half">
            <h4>Date of Birth</h4>
            <div class="input-group">
                <input name="birthday" type="date"
                @if ($user)
                    @if ($user->user_detail->birthday)
                    value="{{ $user->user_detail->birthday }}"
                    @endif
                @else
                placeholder='Today'
                @endif
                >
            </div>
        </div>
        <div class="col-half">
            <h4>Gender</h4>
            <div class="input-group">
            <input id="gender-male" type="radio" name="gender" value="male"
            @if ($user)
                @if ($user->user_detail->gender == 'male')
                checked
                @endif
            @endif
            >
            <label for="gender-male">Male</label>
            <input id="gender-female" type="radio" name="gender" value="female"
            @if ($user)
                @if ($user->user_detail->gender == 'female')
                checked
                @endif
            @endif
            >
            <label for="gender-female">Female</label>
            </div>
        </div>
        </div>
        <div class="row">
        <h4>Department Details</h4>
        <div class="input-group input-group-icon">
            <select class="form-control" id="make-department-option" name="department" autocomplete="department" required>
                <option value="" selected>Select Department</option>
                @foreach ($departments as $department )
                <option value="{{ $department['id'] }}">
                {{ $department['department_name'] }}</option>
                @endforeach
            </select>
            <div class="input-icon"><i class="fa-solid fa-building-user"></i></div>
        </div>
        <div class="input-group input-group-icon">
            <select class="form-control" id="make-doctor-option" name="doctor" autocomplete="doctor" required>
            </select>
            <div class="input-icon"><i class="fa-solid fa-user-doctor"></i></div>
        </div>

        <div class="row">
            <h4>Appointment Date & Time</h4>
            <div class="input-group">
                <input name="appoint-date" type="date" required>
            </div>
            <div class="input-group">
                <input name="appoint-time" type="time" required>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Make Appointment">
    </form>
</div>


</div>

@endsection
