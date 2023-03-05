@extends('dashboard.sidebar')

@section('content')
<hr style="height: 70px">
<h3 class="text-center">Tests</h3>
<div class="container">
    <table  class="table text-center">
        <thead>
            <tr>
                <th>Patient name </th>
                <th>Requested tests </th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $tests as $test )
            <tr>
                <td>
                    <a href="{{ route('profile',[$test->appoint->patient->id]) }}">{{ $test->appoint->patient->user_detail->full_name  }}</a>
                </td>
                <td>
                    {{ $test['tests'] }}
                </td>
                <td>
                    <a href="{{ route('donetests', $test['appoint_id']) }}">Process</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    No Requested Test
                </td>
            </tr>
            @endforelse
        </tbody>
        </table>
        </div>
@endsection
