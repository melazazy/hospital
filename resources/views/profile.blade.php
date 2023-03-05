@extends('layouts.app')

@section('content')

<div class="container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-dark">
                                <div class="m-b-25">
                                        <div class="img-profile">
                                            <img id="img-profile" class="rounded-circle mt-1" width="100px"
                                            @if (!empty($user->user_detail['profile_photo_path']))
                                            src="{{ asset('storage/images/profile/'.$user->user_detail['profile_photo_path']) }}"
                                            @else
                                            src="
                                            https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                            @endif
                                            />
                                        </div>
                                    </div>
                                    <h2 class="f-w-600">{{ $user->user_detail['full_name'] }}</h2>
                                    <p>{{ $user['type'] }}</p>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>

                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h2>Information</h2>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>Email</p>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>Phone</p>
                                        <p>{{ $user->user_detail['phone'] }}</p>
                                    </div>

                                </div>
                                {{-- <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6> --}}
                                <div class="row">
                                    @if ($user->department_id)
                                    <div class="col-sm-6">
                                        <p>Department</p>

                                        <p>{{ $user->user_detail->department->department_name }}</p>
                                    </div>
                                    @endif
                                    <div class="col-sm-6">
                                        <p>Gender</p>
                                        <p>{{ $user->user_detail->gender }}</p>

                                    </div>
                                </div>
                                    <!-- Grid container -->
                                    <h3>Social</h3>
                                <div class="container p-4 pb-0">
                                <section class="mb-4">
                                    <!-- facebook -->
                                    <a class="btn text-white btn-floating m-1"
                                        style="background-color: #3b5998;"
                                        href="#!"
                                        role="button">
                                        <i class='bx bxl-facebook-square'></i>
                                    </a>
                                    <!-- Twitter -->
                                    <a class="btn text-white btn-floating m-1"
                                        style="background-color: #55acee;"
                                        href="#!"
                                        role="button">
                                        <i class='bx bxl-twitter' ></i>
                                    </a>
                                    <!-- Instagram -->
                                    <a class="btn text-white btn-floating m-1"
                                        style="background-color: #f375f3;"
                                        href="#!"
                                        role="button">
                                        <i class='bx bxl-instagram' ></i>
                                    </a>
                                    <!-- Linkedin -->
                                    <a class="btn text-white btn-floating m-1"
                                        style="background-color: #0082ca;"
                                        href="#!"
                                        role="button">
                                        <i class='bx bxl-linkedin-square'></i>
                                    </a>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
