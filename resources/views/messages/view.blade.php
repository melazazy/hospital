@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="container">
        <div class="header">
            <h3>From: <span>{{ $message->sender->user_detail['full_name'] }}</span></h3>
            <h3>date: <span>{{ $message['date'] }}</span></h3>
            <h3>subject: <span>{{ $message['subject'] }}</span></h3>
        </div>
        <div class="body">
            <p class="mail--body">
                {!! $message['body'] !!}
            </p>
        </div>
        <div class="mail--footer">
            <div class="re">
                <form action="{{ route('messages.edit',$message['id']) }}" method="get">
                    <button class="btn btn-primary" >replay</button>
                </form>
            </div>
            <div class="del">
                <form action="{{ route('messages.destroy',$message['id']) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="url" value="{{ URL::previous() }}">
                <button class="btn btn-danger">delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
