<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Free Rooms</div>
                <div class="number">{{ $rooms }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">patients IN</div>
                <div class="number">{{ $in_patients }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </div>
    </div>
    <div class="overview-boxes">
        <a class="box" href="{{ route('addpatient')}}">
            <div class="right-side">
                <div class="box-topic">Add Patient</div>
            </div>
        </a>
        <a class="box" href="{{ route('book4patient')}}">
            <div class="right-side">
                <div class="box-topic">Book Appointment</div>
            </div>
        </a>
        <a class="box" href="{{ route('emergency')}}">
            <div class="right-side">
                <div class="box-topic">Emergency</div>
            </div>
        </a>
        <a class="box" href="{{ route('bookRoom')}}">
            <div class="right-side">
                <div class="box-topic">Book Room</div>
            </div>
        </a>
    </div>
</div>
