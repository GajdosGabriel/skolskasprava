<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            @if(Auth::user()->hasRole(1) OR Auth::user()->hasRole(2))
            <!-- Left Side Of Navbar -->
            <ul class="nav nav-pills mr-auto">
                <li class="nav-item">
                <a href="{{ route('workers.index') }}" class="nav-link {{ request()->is('ucitelia') ? 'active' : '' }}">Učitelia</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('grades.index') }}" class="nav-link {{ request()->is('triedy') ? 'active' : '' }}">Triedy</a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('folks.index') }}" class="nav-link {{ request()->is('rodicia') ? 'active' : '' }}">Rodičia</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link {{ request()->is('students') ? 'active' : '' }}">Žiaci</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('messenger.index') }}" class="nav-link {{ request()->is('messenger/*/*') ? 'active' : '' }}">
                         Messenger
                        @if($usermessages = App\Messenger::whereReadAt(null)->whereRequestedUser(auth()->user()->id)->get()->count() > 0)
                        <span class="badge badge-danger">{{ $usermessages }}</span>
                        @endif
                    </a>
                </li>

                @if(auth()->user()->isSuperAdmin())
                    <li class="nav-item">
                        <a href="{{ route('administrator.index') }}" class="nav-link {{ request()->is('administrator') ? 'active' : '' }}">Admin</a>
                    </li>
                @endif
            </ul>
            @endif

            @if(Auth::user()->hasRole(3))
                    <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ route('folks.show', [auth()->user()->id, auth()->user()->slug]) }}" class="nav-link">Formulár súhlas</a>
                </li>
            </ul>
            @endif
            @endauth

            @if(auth()->check() AND isset(auth()->user()->grade->id))
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('grades.show', [auth()->user()->grade->id]) }}">Moja trieda  {{ auth()->user()->grade->name }}</a>
                </li>
            </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Prihlásenie') }}</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registrácia') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->full_name() }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('user.edit', [ auth()->user()->id, auth()->user()->slug ]) }}" class="dropdown-item">Profil</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('web.Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
            </ul>
        </div>
    </div>
</nav>