<div class="home-content">
    <div class="overview-boxes">
        <a class="box" href="{{ route('patientAppoints') }}">
            <div class="right-side">
                <div class="box-topic"> Appointments</div>
                <div class="number">{{ $total['appoint'] }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </a>
        <a class="box" href="{{ route('bills') }}">
            <div class="right-side">
                <div class="box-topic">Total Bills</div>
                <div class="number">{{ $total['bill'] }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </a>
        <a class="box" href="{{ route('patientprescription') }}">
            <div class="right-side">
                <div class="box-topic">Prescriptions</div>
                <div class="number">{{ $total['pre'] }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </a>
        <a class="box" href="{{ route('tests') }}"">
            <div class="right-side">
                <div class="box-topic">Tests</div>
                <div class="number">{{ $total['test'] }}</div>
            </div>
            <i class='bx bxs-calendar cart'></i>
        </a>
    </div>
</div>
