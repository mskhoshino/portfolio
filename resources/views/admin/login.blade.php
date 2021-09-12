@extends('admin.layout')
@section('content')

        <!-- <h2 class="title">管理画面にログイン</h2> -->
        <form class="new_user" id="new_user" action="{{ url('admin/login') }}" accept-charset="UTF-8" method="post">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="user_name">ユーザー名</label><br>
            <input id="user_name" type="user_name" class="form-control" name="user_name" value="" required autofocus>
          </div>

          <div class="form-group">
            <label for="password">パスワード</label><br>
            <input id="password" type="password" class="form-control" name="password" required>
                <span class="help-block">
                    <strong>
                    	@foreach ($errors->all() as $error)
                    	<p class="error_message">{{ $error }}</p>
	                    @endforeach
                    </strong>
                </span>
          </div>

          <div class="form-group login-button">
            <input type="submit" name="commit" value="ログイン" class="loginBtn" data-disable-with="ログイン">
          </div>
        </form>

        <footer>©2021 M.Hoshino</footer>

@endsection
