@extends('dashboard.sidebar')

@section('content')

    <div class="home-content">
        <div class="rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <label for="img">
                                <div class="img-profile">
                                    <img id="img-profile" class="rounded-circle mt-1" width="150px"
                                    @if (!empty($user->user_detail['profile_photo_path']))
                                    src="{{ asset('storage/images/profile/'.$user->user_detail['profile_photo_path']) }}"
                                    @else
                                    src="
                                    https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                    @endif
                                    />
                                    <span>Change</span>
                                </div>
                            </label>
                        <span class="font-weight-bold">{{ $user['username'] }}</span>
                        <span class="text-black-50">{{ $user['email'] }}</span>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Change Your Password?') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-3">
                            <form action="{{ route('editprofile',$user['id']) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="col-md-12"><label class="labels">Full name</label>
                                    <input name="full_name" type="text" class="form-control"
                                    @if(!empty($user->user_detail['full_name']))
                                    value="{{ $user->user_detail['full_name'] }}" >
                                    @endif
                                </div>
                                @if($user['type']!='patient')
                                <div class="col-md-12"><label for="department" class="labels">Department</label>
                                    <select class="form-control" name="department" autocomplete="department">
                                        <option value="" selected>Select Department</option>
                                        @foreach ($departments as $department )
                                        <option
                                        value="{{ $department['id'] }}" @if ($user->user_detail['department_id']==$department['id'])
                                        selected
                                    @endif >
                                        {{ $department['department_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-md-12"><label class="labels">Birthday</label>
                                    <input name="birthday" type="date" class="form-control"
                                    @if(!empty($user->user_detail['birthday']))
                                    value="{{ $user->user_detail['birthday'] }}" >
                                    @endif
                                </div>
                                <div class="col-md-12"><label for="gender" class="labels">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">select Option</option>
                                        @if ($user->user_detail['gender']=='male')
                                        <option value="male" selected >Male</option>
                                        <option value="female" >Female</option>
                                        @else
                                        <option value="male"  >Male</option>
                                        <option value="female"selected >Female</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12"><label class="labels">Address</label>
                                    <input name="address" type="text" class="form-control"
                                    @if(!empty($user->user_detail['address']))
                                        value="{{ $user->user_detail['address'] }}" >
                                    @endif
                                </div>
                                <div class="col-md-12"><label class="labels">Phone</label>
                                    <input name="phone" type="tel" class="form-control"
                                    @if(!empty($user->user_detail['phone']))
                                        value="{{ $user->user_detail['phone'] }}" >
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    Choose Img
                                    <input type="file" name="image" id="img">
                                </div>
                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


