@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h3>Limits </h3>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Medicin</th>
                    <th scope="col">Quant</th>
                    <th scope="col">limit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($limits as $limit )
                <tr>
                    <td>{{ $limit['name'] }}</td>
                    <td>{{ $limit['start_quantity'] }}</td>
                    <td>{{ $limit['limit_quant'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


