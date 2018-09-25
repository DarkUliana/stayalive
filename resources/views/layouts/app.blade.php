<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/menu.css') }}" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css">

    @if(Request::is('shop-articles'))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/titatoggle/2.1.2/titatoggle-dist-min.css"/>
    @endif

    @if(Request::is('dialogs/*'))
        {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    @endif


</head>
<body>
<style>
    .up, .down {
        font-size: 1.6em;
        position: absolute;
    }

    .up {

        bottom: 8px;

    }

    .down {
        top: 8px;
    }

    .sort {
        height: 20px;
        width: 10px;

    }

    /*th {*/
    /*font-size: 14px;*/
    /*}*/

</style>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            {{--<div class="row">--}}
            <div class="col-md-2">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Admin') }}
                </a>
            </div>

            @guest
            @else
                @if(env('PRODUCTION'))
                    <div class="col-md-7 text-center border border-danger rounded"><h4>It`s a production version!</h4>
                    </div>
                @else
                    <div class="col-md-7 text-center border border-success rounded"><h4>It`s a test version!</h4></div>
                @endif
            @endguest

            {{--<button class="navbar-toggler" type="button" data-toggle="collapse"--}}
            {{--data-target="#navbarSupportedContent"--}}
            {{--aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--<span class="navbar-toggler-icon"></span>--}}
            {{--</button>--}}

            <div class="col-md-3">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                {{--<ul class="navbar-nav mr-auto">--}}

                {{--</ul>--}}

                <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                        @else

                            @if(env('PRODUCTION'))
                                <li><a class="nav-link btn btn-success font-weight-bold"
                                       href="{{ env('SECOND_URL').'/'.Request::path() }}">Go
                                        to
                                        test</a></li>
                            @else
                                <li><a class="nav-link btn btn-danger font-weight-bold"
                                       href="{{ env('SECOND_URL').'/'.Request::path() }}">Go
                                        to
                                        production</a></li>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            {{--</div>--}}
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->

<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

@if(!Request::is('rewards*'))
    <script src="{{ asset('js/parts.js') }}"></script>
    <script src="{{ asset('js/select.js') }}"></script>
@endif

@if(Request::is('items'))
    <script src="{{ asset('js/items.js') }}"></script>
@endif

@if(Request::is('players'))
    <script src="{{ asset('js/players.js') }}"></script>
@endif

@if(Request::is('players/*'))
    <script src="{{ asset('js/player.js') }}"></script>
@endif

@if(Request::is('shop-articles'))
    <script src="{{ asset('js/shop-articles.js') }}"></script>
@endif

@if(Request::is('shop-articles/*'))
    <script src="{{ asset('js/shop-article.js') }}"></script>
@endif

@if(Request::is('technologies'))
    <script src="{{ asset('js/technologies.js') }}"></script>
@endif

@if(Request::is('dialogs/*') || Request::is('quests/*'))

    <script src="{{ asset('js/dialog.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endif

@if(Request::is('descriptions'))
    <script src="{{ asset('js/descriptions.js') }}"></script>
@endif

@if(Request::is('rewards/*'))
    <script src="{{ asset('js/reward.js') }}"></script>
@endif

@if(Request::is('/'))
    <script src="{{ asset('js/merge.js') }}"></script>
@endif

@if(Request::is('restorable-objects/*'))
    <script src="{{ asset('js/restorable-object.js') }}"></script>
@endif

@if(Request::is('notifications/*'))
    <script src="{{ asset('js/notification.js') }}"></script>
@endif

@if(Request::is('mobs'))
    <script src="{{ asset('js/mobs.js') }}"></script>
@endif
@if(Request::is('mobs/*'))
    <script src="{{ asset('js/mob.js') }}"></script>
@endif

@if(Request::is('mobs-loot/*'))
    <script src="{{ asset('js/mobs-loot.js') }}"></script>
@endif

@if(Request::is('banlist'))
    <script src="{{ asset('js/select.js') }}"></script>
@endif

@if(Request::is('recipes'))
    <script src="{{ asset('js/recipes.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
            integrity="sha256-1A78rJEdiWTzco6qdn3igTBv9VupN3Q1ozZNTR4WE/Y=" crossorigin="anonymous"></script>
@endif

@if(Request::is('loot-collections/*'))
    <script src="{{ asset('js/loot-collection.js') }}"></script>
@endif

@if(Request::is('loot-objects/*'))
    <script src="{{ asset('js/loot-object.js') }}"></script>
@endif

@if(Request::is('diary-storage-notes/*'))
    <script src="{{ asset('js/diary-storage-note.js') }}"></script>
@endif
</body>
</html>
