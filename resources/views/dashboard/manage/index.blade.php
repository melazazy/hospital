@extends('dashboard.sidebar')
@section('content')
<div class="container">
    <br><br>
    <br><br>
    <div class="panel-heading ui-sortable-handle">
        <div class="btn-group">
        <a class="btn btn-success" href="{{ route('register') }}">  <i class="fa-solid fa-user-plus"></i>  Add User</a>
        </div>
    </div>
    <div class="row">
        <h3 class="text-center pb-4">{{ ucfirst($users[0]['type']) }} Management</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID No</th><th>User Name</th><th>Created at</th><th>status</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                <tr>
                    <td><input type="radio" name="radioGroup">
                        <label>{{ $user['id']}}</label>
                    </td>
                    <td>{{ $user['username'] }}</td>
                    <td>{{ $user['created_at'] }}</td>
                    <td>
                        @empty($user['email_verified_at'])
                        Not Verified yet
                        @else
                        <i class="text-info fa-solid fa-check-double"></i>
                        Verified
                        @endempty

                    </td>
                    <td class="text-center">
                        @empty($user['active'])
                        <span>
                            <form class="d-inline" action="{{ route('active') }}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" value="{{ $user['id'] }}">
                                <button type="submit" class="btn btn-info"  data-toggle="tooltip" data-placement="left" title="Active "><i class="fa-solid fa-check-double" aria-hidden="true"></i>
                                </button>
                            </form>
                        </span>
                        @endempty
                        <span>
                            <form class="d-inline" action="{{ route('deleteUser',[$user['id']]) }}" method="post">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger"  data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa-solid fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
