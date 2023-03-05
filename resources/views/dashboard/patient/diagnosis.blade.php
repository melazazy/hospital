@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h3>My Diagnosis </h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">diagnosis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diagnosis as $diagnosi )
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($diagnosi ['created_at'])->format('d/m/Y')}}</td>
                        <td >
                            {{ $diagnosi['diagnosing'] }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection


