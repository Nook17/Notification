@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (!count($users))
                <div class="card-body text-danger text-center">
                    <h3 class="mt-3">I'm sorry, I can't find anything</h3>
                    <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm mt-3">back</a>
                </div>
            @endif
            @foreach ($users as $user)
                <div class="card border-primary mb-3">
                    <div class="card-header">{{ $user->name }}</div>
                    <div class="card-body text-primary">
                    <h5 class="card-title">{{ $user->email }}</h5>
                    {{-- <p class="card-text">{{ $user->id }}</p> --}}
                    <p class="card-text">
                        @if (!is_follow($user->id))
                            <form action="{{ route('add_follow', $userName) }}" method="post">
                            @csrf
                                <input type="hidden" name="user_follow" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-outline-success btn-sm">follow</button>
                            </form>
                        @else
                            <form action="{{ route('del_follow', [$user->id, $userName]) }}" method="post">
                            @csrf
                            @method('DELETE')
                                <a href="" class="btn btn-outline-danger btn-sm" onclick="this.parentNode.submit();">unfollow</a>
                            </form>
                        @endif
                    </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
