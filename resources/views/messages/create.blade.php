@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <form action="{{ route('messages.store') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="from" value="{{ Auth()->user()->id }}">
            <input type="hidden" name="to" value="3">
            <div class="mb-3">
                <label for="user_name" class="form-label">User</label>
                <input type="email" name="user" class="form-control" id="user_name" placeholder="name@example.com">
            </div>
            <div id="userResult"></div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" id="subject" >
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="message" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit"> <i class="fa-solid fa-paper-plane"></i> Send</button>
            </div>
        </form>
    </div>
</div>
@endsection
