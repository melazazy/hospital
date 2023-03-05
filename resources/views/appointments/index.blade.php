@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row department-row">
        @foreach ($departments as $department )
                <div class="card col-5 mb-5 ml-2" style="width: 25rem;">
                    <div class="department-img">
                        <img src="storage/images/departments/{{$department->department_photo_path  }}" alt="...">
                    </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $department->department_name }}</h5>
                    <h5 class="card-title"> Total Appointments: {{ $department->appointments->count() }}</h5>
                    <a href="{{ route('appointments.show',$department->id)}}" class="btn btn-primary">View Appointement</a>
                </div>
                <p>{{ $department->description }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection
