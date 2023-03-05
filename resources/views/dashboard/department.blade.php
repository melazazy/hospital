<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="asset('favicon.ico')">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
    <br><br>
    <br><br>
    <div class="panel-heading ui-sortable-handle">
        <div class="btn-group">
        <a class="btn btn-success" href="{{ route('register') }}">  <i class="fa-solid fa-user-plus"></i>  Add User</a>
        </div>
    </div>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0;$i<3;$i++)
                <tr>
                    <td><input type="radio" name="radioGroup">
                        <label>{{ $i+1 }}</label>
                    </td>
                    <td>General Surgery</td>
                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                    <td>
                        @if (($i+2)%2 !=0)
                            <button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa-solid fa-check-double" aria-hidden="true"></i>
                            </button>
                        @else
                        Active
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa-solid fa-trash" aria-hidden="true"></i></button>
                    </td>
                </tr>
                @endfor
                <tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
