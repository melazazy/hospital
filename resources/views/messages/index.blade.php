@extends('dashboard.sidebar')
@section('content')
<div class="home-content">
        @if(session()->has('del'))
        <div class="alert alert-danger">
            {{ session()->get('del') }}
        </div>
        @endif
    <div class="links">
        <ul class="nav nav-tabs ">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('messages.index') }}">Inbox
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sent') }}">Send</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="{{ route('messages.create') }}" role="button"><i class="fa-solid fa-pen"></i> <span> Compose</span></a>
            </li>
        </ul>
    </div>
    <div id="inbox" class="overview-boxes">
        <h3 class="text-yellow-400">Inbox</h3>
        <table class="table table-hover table-responsive">
            <thead>
                <tr class="text-center">
                    <th scope="col">&ensp;</th>
                    <th scope="col">Date</th>
                    <th scope="col">from</th>
                    <th scope="col">subject</th>
                    <th scope="col">manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inbox as $r )
                @if ($r['isRead'] != 0)
                    <tr class="text-center align-middle table-secondary">
                @else
                    <tr class="text-center align-middle table-light">
                @endif
                <td>
                    <form action="{{ route('starred',$r['id']) }}" method="post">
                        @csrf
                        @method('POST')
                    @if ($r['isStarred'] != NULL)
                    <button type="submit"><i style="color: blue" class="fa-sharp fa-solid fa-star"></i>
                    </button>
                    @else
                    <button type="submit"><i style="color: gray" class="fa-sharp fa-solid fa-star"></i>
                    </button>
                    @endif
                    </form>
                </td>
                    <th>{{ $r['date'] }}</th>
                    <td class="d-flex align-items-center">
                        @if($r->sender != NULL)
                            @if($r->sender->user_detail['profile_photo_path'] != NULL)
                            <img class="img" src="{{ asset('storage/images/profile/'.$r->sender->user_detail['profile_photo_path']) }}" alt="photo">
                            @else
                            <img class="img" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="photo">
                            @endif
                        @endif
                    <span>
                        @if($r->sender != NULL)
                            @if($r->sender->user_detail['full_name'] != NULL)
                            {{ $r->sender->user_detail['full_name'] }}
                            @else
                            {{ $r->sender->username }}
                            @endif
                        @endif</span> </td>
                    <th><a href="{{ route('messages.show',[$r['id']]) }}">{{ $r['subject'] }}</a></th>
                    <th>
                        <div class="del">
                            <form action="{{ route('messages.update',$r['id']) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="url" value="{{ URL::previous() }}">
                            <button>delete</button>
                            </form>
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $inbox->links() }}
</div>
@endsection
