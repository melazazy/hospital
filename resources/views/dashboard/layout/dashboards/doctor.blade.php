<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Appointments</div>
                <div class="number">{{ $data['total_appoints'] }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
            <div class="box-topic">Booked Appointments</div>
            <div class="number">{{ $data['booked_appoints'] }}</div>
            </div>
            <i class='bx bxs-calendar-plus cart two' ></i>
        </div>
        <div class="box">
            <div class="right-side">
            <div class="box-topic">Done Appointments</div>
            <div class="number">{{ $data['done_appoints'] }}</div>
            </div>
            <i class='bx bxs-calendar-check cart three' ></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Requested Appointments</div>
                <div class="number">{{ $data['appoint_req'] }}</div>
            </div>
            <i class='bx bxs-calendar-event cart four'></i>
        </div>
    </div>
    <div class="container">
        <div class="sales-boxes">
            <div class="top-sales box">
                <div class="title">Recently charge</div>
                <ul class="top-sales-details">
                    @forelse ( $data['bills'] as $b )
                    <li>{{ $b->patient->user_detail['full_name'] }} ==> {{ $b['doctor_charge'] }} $$</li>
                    @empty
                        <p>No Charges yet</p>
                    @endforelse
                </ul>
                @if ($data['charges'] > 0)
                <div class="title">With Total Charge {{ $data['charges'] }} $</div>
                @endif
            </div>
            <div class="top-sales box">
                <div class="title">Frequency Patients</div>
                <ul class="top-sales-details">
                    @forelse ($data['patients'] as $pa)
                    <li>
                        <a href="{{ route('profile',$pa->patient->id) }}">
                        <img src="{{ asset('storage/images/profile/'.$pa->patient->user_detail['profile_photo_path'])}}" alt="">
                        <span class="product">{{ $pa->patient->user_detail['full_name'] }}</span>
                        </a>
                    </li>
                    @empty
                        No peatient
                    @endforelse
                </ul>
            </div>
            <div class="top-sales box">
                <div class="title">Recently Patients</div>
                <ul class="top-sales-details">
                    @forelse ($data['patients'] as $pa)
                    <li>
                        <a href="{{ route('profile',$pa->patient->id) }}">
                        <img src="{{ asset('storage/images/profile/'.$pa->patient->user_detail['profile_photo_path'])}}" alt="">
                        <span class="product">{{ $pa->patient->user_detail['full_name'] }}</span>
                        </a>
                    </li>
                    @empty
                        No patient
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
