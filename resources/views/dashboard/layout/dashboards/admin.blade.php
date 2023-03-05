<div class="home-content">
    <div class="overview-boxes">
        @foreach ($total as $key=>$value )
        <div class="box">
            <div class="right-side">
            <div class="box-topic">{{ $key }}</div>
            <div class="number">{{ $value[0]}}</div>
            <div class="indicator">
                @if ($value[1]>0)
                    <i class='bx bx-right-arrow-alt'></i>
                <span class="text"> <span class="online">{{ $value[1]}}</span> Online</span>
                @else
                No One Online
                @endif

            </div>
            </div>
            <i class="fa-solid fa-users cart {{ $key }}"></i>
        </div>
        @endforeach
    </div>

    <div class="sales-boxes">
        <div class="recent-sales box">
            <div class="sales-details">
                <div class="container">
                    <div class="details">
                    <h3>Rooms</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total Rooms</th> <th>Free Rooms</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $rooms['allrooms'] }}</td><td>{{ $rooms['emptyrooms'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="sales-details">
                    <div class="container">
                    <div class="details">
                        <h3>Charges</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Rooms</th> <th>Doctors</th>
                                        <th>Medical</th> <th>Test</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> $$ {{ $charges['room_charge'] }}</td>
                                        <td> $$ {{ $charges['doctor_charge'] }}</td>
                                        <td> $$ {{ $charges['medical_charge'] }}</td>
                                        <td> $$ {{ $charges['test_charge'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
