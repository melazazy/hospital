@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <h1 class="heading-section">Contact US</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Contact Us </h3>
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                            <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                <form action="{{ route('sendMail') }}" method="POST" id="contactForm" name="contactForm" class="contactForm">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="name">Full Name <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="email">Email Address <span class="required">*</span></label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="subject">Subject <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="#">Message <span class="required">*</span></label>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Send Message" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @php
                            $contact = [
                                ['fa-solid fa-map-marker','<span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016'],
                                ['fa-solid fa-phone','<span>Phone:</span> <a href="tel://1234567920" target="_blank" >+ 1235 2355 98</a> , <a href="tel://0987654321" target="_blank" >+ 0987 6543 21</a>'],
                                ['fa-brands fa-square-whatsapp','<span>Phone:</span> <a href="https://wa.me/+201094569809" target="_blank" > + 1235 2355 98</a>>'],
                                ['fa-solid fa-paper-plane','<span>Email:</span> <a href="mailto:info@yoursite.com" target="_blank" >info@yoursite.com</a>'],
                                ['fa-solid fa-globe','<span>Website</span> <a href="#" target="_blank" >yoursite.com</a>']
                    ];
                        @endphp
                    <div class="col-md-6 contact-details">
                        @foreach ($contact as $c)
                        <div class="contact-wrap w-100 p-md-3 p-4">
                            <div class="card-stats statistic-box ">
                                <div class="card-header card-header-info card-header-icon position-relative border-0 text-right px-3 py-0">
                                    <div class="contact-icon d-flex align-items-center justify-content-center">
                                        <i class="{{ $c[0] }}"></i>
                                    </div>
                                    <div class="text">
                                        <p> {!! $c[1] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
