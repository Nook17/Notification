<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Quick News') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <ion-icon name="notifications-outline"></ion-icon><span class="badge badge-light text-danger">
                                @if (auth()->user()->unreadNotifications->count())
                                    {{ auth()->user()->unreadNotifications->count() }}
                                @endif
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('markAsRead') }}" class="dropdown-item text-success">Read all notification</a>
                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item" href="#" style="background-color: #a9a9a9">
                                    {!! htmlspecialchars_decode($notification->data['message']) !!}
                                </a>
                            @endforeach
                            @foreach (auth()->user()->readNotifications as $notification)
                                <a class="dropdown-item" href="#">
                                    {!! htmlspecialchars_decode($notification->data['message']) !!}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                             <ion-icon name="log-out"></ion-icon>
                                            {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('settings_index') }}"><ion-icon name="settings"></ion-icon> Settings</a>
                        </div>
                    </li>
                @endguest
            </ul>
            <form action="{{ route('search') }}" method="POST" class="form-inline my-2 my-lg-0">
                @csrf
                <input class="form-control mr-sm-2" type="search" name="name" placeholder="Search friends" aria-label="Search">
                <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit"><ion-icon name="search"></ion-icon></button>
            </form>
        </div>
    </div>
</nav>
