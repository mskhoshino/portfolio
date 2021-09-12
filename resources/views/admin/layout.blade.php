<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/custom.css') }}">
    <title>管理画面</title>
  </head>
  <body>
  <header>
      @if(request()->path() == 'admin/login')
        <div class="container">
            <ul class="menu">
              <li class="menu-list"><a href="{{ route('user.index') }}" class="menu-link">Translate</a></li>
              <li class="menu-list"><a href="{{ route('user.list') }}" class="menu-link">Contents</a></li>
              <li class="menu-list"><a href="{{ route('login') }}" class="menu-link">Admin</a></li>
            </ul>
          </div>
        </header>
      @else
        <a value="ログアウト" href="{{ route('login') }}">
          ログアウト
        </a>
      @endif

      <div class="main-contents">
        @yield('content')
      </div>
  </body>
</html>
