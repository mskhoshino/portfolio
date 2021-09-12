@extends('admin.layout')
@section('content')

        <div>
          <h2 class="title">管理画面TOP</h2>
          <li>
            <a href="{{ route('admin.list') }}">記事一覧</a>
          </li>
          <li>
            <a href="{{ route('admin.message') }}">記事投稿</a>
          </li>
        </div>

@endsection