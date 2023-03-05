@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">
        <br>
        <ul>
        @foreach ($text as $med)
            <li>
            {{$med  }}
            </li>
        @endforeach
        </ul>
        <form action="{{ route('prescriptions.update',[$pre['id']]) }}" method="post">
            @csrf
            @method('PUT')
                @foreach ($medics as $key => $medic )
                <div id="row">
                    <div class="input-group m-3">
                    <input name="key[]" type="hidden" class="form-control " value="{{ $key }}" >
                    <input name="medicine[]" type="text" class="form-control medicine" value="{{ $medic }}" >
                    <input name="count[]" type="number" class="form-control count" placeholder="Count">
                    </div>
                </div>
                @endforeach
            <input type="hidden" name="id" value="{{ $pre['id'] }}">
            <input type="hidden" name="type" value="pull">
            <label for="charge">Total Charge</label>
            <div class="form-group">
                <input class="form-control" id="charge" type="number" name="charge" required value="0.00" >
            </div>
            <div class="form-group">
                <input class="form-control btn btn-primary"  type="submit" value="Finish">
            </div>
        </form>
    </div>
</div>
@endsection
