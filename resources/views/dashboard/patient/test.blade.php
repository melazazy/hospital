@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <h3>My Tests </h3>
        {{-- display tests --}}
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Test Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tests as $key=>$test )
                <tr>
                    <td class="text-center" >
                        <a href="{{ route('readpdf',[$test]) }}" target="_blank">{{ $key }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


