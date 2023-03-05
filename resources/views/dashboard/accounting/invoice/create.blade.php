@extends('dashboard.sidebar')
@section('content')

<div class="home-content">
    <div class="container">
        <p>
            {{ $appoint['charges_text'] }}
        </p>

        <form action="{{ route('invoices.store') }}" method="post">
            @csrf
            <div class="invoice">
                <input type="hidden" name="appoint_id" value="{{ $appoint['id'] }}">
                <div class="form-group">
                    <label for="doctor">doctor Charge:    </label>
                    <input class="" type="number" id="doctor" name="doctor">
                </div>
                <div class="form-group">
                    <label for="test">tests Charge:     </label>
                    <input class="" type="number" id="test" name="test">
                </div>
                <div class="form-group">
                    <label for="pharmacy">Pharmacy Charge: </label>
                    <input class="" type="number" id="pharmacy" name="pharmacy">
                </div>
                <div class="form-group">
                    <label for="room">Room Charge:  </label>
                    <input class="" type="number" id="room" name="room">
                </div>
                <div class="form-group">
                    <textarea name="notes" id="notes" cols="90" rows="10" placeholder="Notes..." style="padding: 10px"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Save Invoice">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
