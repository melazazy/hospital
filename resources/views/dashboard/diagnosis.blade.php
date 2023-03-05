@extends('dashboard.sidebar')

@section('content')
<hr style="height: 70px">
<h3 class="text-center">Diagnosis of</h3>
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    {{-- Start Profile --}}
    <div class="row m-l-0 m-r-0 border">
        <div class="col-sm-4 bg-c-lite-green user-profile">
            <div class="card-block text-center text-dark">
                <div class="m-b-25">
                        <div class="img-profile">
                            <img id="img-profile" class="rounded-circle mt-1" width="100px"
                            @if (!empty($appointment->patient->user_detail['profile_photo_path']))
                            src="{{ asset('storage/images/profile/'.$appointment->patient->user_detail['profile_photo_path']) }}"
                            @else
                            src="
                            https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                            @endif
                            />
                        </div>
                    </div>
                    <h2 class="f-w-600">{{ $appointment->patient->user_detail['full_name'] ?? 'anonymous'}}</h2>
                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Gender: {{ $appointment->patient->user_detail->gender ?? 'Not Provide' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <p>Age: @php $Date = $appointment->patient->user_detail->birthday ;
                            $birthday = new DateTime($Date);$interval = $birthday->diff(new DateTime);
                            echo $interval->y. ' Years';
                            @endphp
                        </p>
                    </div>
                </div>
                <div class="row">
                @if (!($diagnosis->isempty()))
                    <p>{{ $diagnosis[0]['diagnosing']}}</p>
                    <small> {{ $diagnosis[0]['updated_at']}}</small>
                @else
                <p class="text-center"> No Prev Diagnosis  </p>
                @endif
                </div>
            </div>
        </div>
    </div>
    {{-- End Profile --}}
    <br>
    {{-- display pdfs Results --}}
    @empty($testresults)
    @else
        <h3> Requested Tests Result </h3>
        <ul class="list-group">
        @forelse ($testresults as $r )
        <li class="list-group-item">
            &rArr;<a class="text-decoration-none" href="{{ route('readpdf',[$r]) }}" target="_blank"> {{ $r }}</a>
        </li>
        @empty
        <li>No Tests Found </li>
        @endforelse
        </ul>
    @endempty

<hr>
        {{-- Require Test --}}
        <form action="{{ route('settests') }}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="appoint_id" value="{{ $appointment['id'] }}">
            @foreach ($tests as $test )
            <input type="checkbox" id="{{ $loop->iteration }}" name="tests[]" value="{{ $test }}">
            <label for="{{ $loop->iteration }}"> {{ $test }} </label><br>
            @endforeach
            <input type="submit" value="Request Test">
            <br><br>
        </form>
        <hr>
        {{-- diagnosis --}}
        <form action="{{ route('setdiagnosis') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="patient_id" value="{{ $appointment['patient_id'] }}">
            <input type="hidden" name="doctor_id" value="{{ $appointment['doctor_id'] }}">
            <input type="hidden" name="appoint_id" value="{{ $appointment['id'] }}">
            <div class="form-group">
            <textarea name="diagnosing" id="" cols="90" rows="10" style="padding: 10px">Diagnosis of here </textarea>
            </div>
            <div class="form-group">
                <label for="charge">Charge</label>
                <input type="number" name="doctor_charge" id="charge">
            </div>
            <div class="form-group">
                <input type="submit" value="Set diagnosis & Process">
            </div>
        </form>
    </div>
</div>
@endsection
