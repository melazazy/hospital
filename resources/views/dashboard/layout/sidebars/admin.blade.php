@php
    $icon=['bxs-user-circle'=>'admin','bx-male'=>'doctor','bxs-heart-circle'=>'employee','bxs-thermometer'=>'patient']
@endphp
@foreach ($icon as $k=>$v)
    <li>
        <a href="{{ route('manage.index',[$v]) }}" class="collapsed">
            <i class='bx {{ $k }} sidebarBtn'></i>
            <span class="links_name">{{ ucfirst($v) }}s</span>
            <i class='bx bx-chevrons-right' ></i>
        </a>
    </li>
@endforeach
