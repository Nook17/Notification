@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="p-3">
            <div class="card border-secondary mt-3" style="max-width: 35rem;">
                <div class="card-header">User</div>
                <div class="card-body text-secondary">
                    <h5 class="card-title text-center">Account:</h5>
                    <form action="{{ route('settings_add') }}" method="POST">
                    @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">UserName</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="UserName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                    <p class="card-text">The email address and password you use to log in to Social services are a part of your Account. To update this information, use this page. If you've forgotten your password, you can retrieve it from the Password Assistance page.</p>
                </div>
            </div>
        </div>
        <div class="p-3">
            <div class="card border-secondary mt-3" style="max-width: 25rem;">
                <div class="card-header">Notification</div>
                <div class="card-body text-secondary">
                    <h5 class="card-title text-center">Mute notifications from people:</h5>
                    <div class="form-group row">
                        <div class="col-sm-4">Follows</div>
                        <div class="col-sm-8">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="follows_email" @if ($settings->notifi_follow >= 2) checked @endif>
                            <label class="form-check-label" for="follows_email">
                                E'mail
                            </label>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="follows_www" @if ($settings->notifi_follow == 1 || $settings->notifi_follow == 3) checked @endif>
                            <label class="form-check-label" for="follows_www">
                                Web site
                            </label>
                            </div>
                        </div>
                        <div class="col-sm-4">News</div>
                        <div class="col-sm-8">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="news_email" @if ($settings->notifi_news >= 2) checked @endif>
                            <label class="form-check-label" for="news_email">
                                E'mail
                            </label>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="news_www" @if ($settings->notifi_news == 1 || $settings->notifi_news == 3) checked @endif>
                            <label class="form-check-label" for="news_www">
                                Web site
                            </label>
                            </div>
                        </div>
                    </div>
                    <p class="card-text">Each user can control personal settings and email communications preferences.</p>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <div class="row justify-content-center mt-4">
        <div class="form-group">
            <div class="col">
                <button type="submit" class="btn btn-outline-primary btn-sm">Save changes</button>
            </div>
        </div>
        </form>
    </div>

</div> <!-- container -->
@endsection
