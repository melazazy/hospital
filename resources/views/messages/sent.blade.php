@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
    <div class="links">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('messages.index') }}"> Inbox
            </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active"aria-current="page"  href="{{ route('sent') }}">Send</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="{{ route('messages.create') }}" role="button"><i class="fa-solid fa-pen"></i> <span> Compose</span></a>
            </li>
        </ul>
    </div>
    <div id="send" class="overview-boxes">
        <h3 class="text-yellow-400">Sent Message</h3>
        <table class="table table-hover table-responsive">
            <thead>
                <tr class="text-center">
                    <th scope="col">&ensp;</th>
                    <th scope="col">Date</th>
                    <th scope="col">To</th>
                    <th scope="col">subject</th>
                    <th scope="col">manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sent as $s)
                    @if ($s['isRead'] != NULL)
                        <tr class="text-center align-middle table-secondary">
                    @else
                        <tr class="text-center align-middle">
                    @endif
                    <td>
                        @if ($s['isStarred'] != NULL)
                        <i style="color: blue" class="fa-sharp fa-solid fa-star"></i>
                        @else
                        <i style="color: gray" class="fa-sharp fa-solid fa-star"></i>
                        @endif
                    </td>
                    <th>{{ $s['date'] }}</th>
                    <td class="d-flex align-items-center">
                        @if($s->receiver != NULL)
                            @if($s->receiver->user_detail['profile_photo_path'] != NULL)
                            <img class="img" src="{{ asset('storage/images/profile/'.$s->receiver->user_detail['profile_photo_path']) }}" alt="photo">
                            @else
                            <img class="img" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="photo">
                            @endif
                        @endif
                        @if($s->receiver != NULL)
                            @if($s->receiver->user_detail['full_name'] != NULL)
                                <span>
                                    {{ $s->receiver->user_detail['full_name'] }}
                                </span>
                                @else
                                    <span>
                                        {{ $s->receiver->username }}
                                    </span>
                            @endif
                        @endif
                    </td>
                    <th><a href="{{ route('messages.show',[$s['id']]) }}">{{ $s['subject'] }}</a></th>
                    <th>
                        <div class="del">
                            <form action="{{ route('messages.update',$s['id']) }}" method="post">
                                @csrf
                                @method('put')
                            <button>delete</button>
                            </form>
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $sent->links() }}
</div>
@endsection
