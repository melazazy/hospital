
<li>
    <a href="{{ route('doctorAppointment', [Auth::user()->id])}}">
        <i class='bx bxs-calendar'></i>
        <span class="links_name">Schedule</span>
    </a>
</li>
<li>
    <a href="{{ route('bookedappointment', [Auth::user()->id])}}">
        <i class='bx bx-notepad'></i>
        <span class="links_name">Appointments</span>
    </a>
</li>
