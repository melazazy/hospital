@extends('dashboard.sidebar')
@section('content')

<div class="home-content">
    <div class="container">
        <h3>finished Invoice</h3>
        <table class="table table-striped table-hover table-responsive text-center">
            <thead>
                <tr>
                    <th scope="col">Bill_ID</th>
                    <th scope="col">Appoint_ID</th>
                    <th scope="col">Patient name</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $bills as $bill )
                <tr>
                    <td scope="row"> <a href="{{ route('invoices.show',[$bill['id']]) }}">{{ $bill['id'] }}</a> </td>
                    <td scope="row">{{ $bill['appoint_id'] }} </td>
                    <td> {{ $bill->patient->user_detail['full_name']  }} </td>
                    <td> {{ $bill['total'] }} </td>
                </tr>
                @empty
                <tr><td colspan="3"> <h3>No Finished Appointment Yet</h3> </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
