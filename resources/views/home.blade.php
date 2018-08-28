@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('add_message') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="What happend?" name="message" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary btn-sm" type="button" id="button-addon2">Send</button>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">Messages</div>
            </div>
            @foreach ($news as $new)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $new->user->name }}</h5>
                        <p class="card-text">{{ $new->message }}</p>
                        <p class="card-text"><small class="text-muted">{{ $new->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Following</div>
                @foreach ($users as $user)
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>

                        <form action="{{ route('home_del_follow', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                            <a href="" class="btn btn-outline-danger btn-sm" onclick="this.parentNode.submit();">unfollow</a>
                        </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
