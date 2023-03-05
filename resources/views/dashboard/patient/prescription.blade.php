@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h3>My prescription </h3>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Prescription</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prescriptions as $pre )
                <tr>
                    <th>{{ $pre->appoint['appoint_date'] }}</th>
                    <td>{{ ($pre->appoint->doctor->user_detail['full_name']) ?? 'Doctor name' }}</td>
                    <td class="text-center" >
                        <a href="{{ route('preshow',[$pre['id']]) }}">{{ $pre['prescription'] }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
