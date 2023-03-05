@extends('dashboard.sidebar')
@section('content')

<div class="home-content">
    <div class="container">
        <div>
            <h3>Requested Invoice</h3>
            <table class="table table-striped table-hover table-responsive text-center">
                <thead>
                    <tr>
                        <th scope="col">Appoint_ID</th>
                        <th scope="col">Patient name</th>
                        <th scope="col">Charges Text</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $appoint  as $pre )
                    <tr>
                        <td scope="row"> <a href="{{ route('invoices.create',[$pre['id']]) }}">{{ $pre['id'] }}</a> </td>
                        <td> {{ $pre->patient->user_detail['full_name']  }} </td>
                        <td> {{ $pre['charges_text'] }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3"> <h3>No Finished Appointment Yet</h3> </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
