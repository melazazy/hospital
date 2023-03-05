@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <form action="{{ route('messages.store') }}" method="post">
            @csrf
            @method('POST')
            <input type="hidden" name="from" value="{{ Auth()->user()->id }}">
            <div class="mb-3">
                <label for="user_name" class="form-label">User</label>
                <input type="email" name="user" class="form-control" id="user_name" readonly="readonly"  value="{{ $message->sender['email'] }}">
            </div>
            <div id="userResult"></div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" id="subject" value="Re: {{ $message['subject'] }}" >
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" class="form-control" id="message" rows="10">{{ $message['body'] }}</textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit"> <i class="fa-solid fa-paper-plane"></i> Replay</button>
            </div>
        </form>
    </div>
</div>
@endsection
