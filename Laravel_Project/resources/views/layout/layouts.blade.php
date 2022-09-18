<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PhoTrip') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    PhoTrip
                </a>
            </div>
            <div class="my-navbar-control">
              @if(Auth::check())
              <span class="my-navbar-item">ユーザー名:{{ Auth::user()->name }}</span>
            </br>

              <a href="{{ route('my_page') }}">マイページ</a>

              /
              <!-- <a class="my-navbar-item" herf = "{{ route('logout') }}" >ログアウト</a> -->
              <a href="/logout" id="logout" class="my-navbar-item">ログアウト</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @else
              <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
              /
              <a class="my-navbar-item" href="{{ route('register') }}">新規登録</a>
              @endif
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>
