@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h3>My Bills </h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill )
                    <tr>
                        <td>{{ $bill ['created_at']}}</td>
                        <td >
                            <a href="{{ route('invoices.show',[$bill['id']]) }}">{{ $bill['total'] }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection


