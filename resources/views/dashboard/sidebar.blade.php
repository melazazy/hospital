
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>
    {{ Auth::user()->type }} | {{ Auth::user()->username }} </title>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet'>

<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@vite(['resources/sass/dashboard/style.css', 'resources/js/dashboard/script.js', 'resources/js/app.js'])
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div>
    <div class="sidebar d-print-none">
        <div class="logo-details">
            <a href="{{ URL('/') }}" class="nav-link">
                <i class='bx bx-pulse'></i>
                <span class="logo_name">Hospital</span>
            </a>
        </div>
        <ul class="nav-links" id="menu">
            <li><a href="{{ route('dashboard') }}" class="active ">
                <i class='bx bx-grid-alt sidebarBtn'></i>
                <span class="links_name">Dashboard</span></a>
            </li>
            <!--  Admins -->
            @if (Auth::user()->type == 'admin')
                @include('dashboard.layout.sidebars.admin')
            @endif
            {{-- Doctors --}}
            @if (Auth::user()->type == 'doctor')
                @if (Auth::user()->user_detail->department->department_name == 'labs')
                    @include('dashboard.layout.sidebars.lab')
                @elseif (Auth::user()->user_detail->department->department_name == 'pharmacy')
                    @include('dashboard.layout.sidebars.pharmacy')
                @else
                    @include('dashboard.layout.sidebars.doctor')
                @endif
            @endif
            @if (Auth::user()->type == 'employee')
                @if (Auth::user()->user_detail->department->department_name  == 'Accounting')
                    @include('dashboard.layout.sidebars.accounting')
                @elseif (Auth::user()->user_detail->department->department_name  == 'reception')
                    @include('dashboard.layout.sidebars.reception')
                @endif
            @endif
            <input id="mailcountid" type="hidden" value="{{ Auth::user()->id }}">
            <hr class="nav-hr">
            <li><a class="position-relative" href="{{ route('messages.index') }}">
                    <i class='bx bx-message'></i>
                    <span class="links_name">Messages</span>
                        <span id="mailcount" class="badge m-2 rounded-pill bg-danger"> </span>
                    </a>
            </li>
            <li><a href="{{ route('profileSetting', [Auth::user()->id])}} ">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span></a>
            </li>
            <li class="">
                    <a  href="{{ route('logout') }}"><i class='bx bx-log-out'></i>
                        <span class="links_name logout">{{ __('Logout') }}</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </li>
        </ul>
    </div>
    <section class="home-section">
        @if(session()->has('msg'))
        <div class="alert alert-success">
            {{ session()->get('msg') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <nav class="d-print-none">
            <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">{{ Auth::user()->type }} Dashboard</span>
            </div>
            <div class="profile-details">
                @if (!empty(Auth::user()->user_detail->profile_photo_path))
                <img src="{{ asset('storage/images/profile/'. Auth::user()->user_detail->profile_photo_path) }}" alt="">
                @else
                <img src="{{ asset('storage/images/profile/avatar.png')}}" alt="">
                @endif
            <span class="admin_name">{{ Auth::user()->username }}</span>

            </div>
        </nav>
    @yield('content')
    </section>
</div>
</body>

</html>

