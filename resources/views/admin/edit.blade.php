@extends('admin.layout')
@section('content')

      <div>
        <h2 class="title">管理画面 編集</h2>
      </div>
      {!! Form::open(['route' => ['admin.update', $admincontent->id], 'method' => 'post']) !!}
        <h3>カテゴリー</h3>
        <select name="category_id">
                <option value="">選択してください</option>
            @foreach($categories as $category)
                @if($admincontent->category_id === $category->category_id)
                <option value="{{ $category->category_id }}" selected>{{ $category->category_name }}</option>
                @else
                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                @endif
            @endforeach
        </select>

        <h3>記事タイトル</h3>
        {!! Form::text('title', $admincontent->title, ['class' => 'form-control', 'style' => 'min-width: 365px;']) !!}
        <h3>投稿内容</h3>
            {!! Form::textarea('content', $admincontent->content, ['class' => 'form-control']) !!}
        <h3>言語</h3>
            <label class="radio-button">
                {{ Form::radio('language_type', '0', $admincontent->language_type == '0' ? 'checked' : '' ) }}
                <span class="radio-button__icon">中国語</span>
            </label>
            <label class="radio-button">
            {{ Form::radio('language_type', '1', $admincontent->language_type == '1' ? 'checked' : '' ) }}
                <span class="radio-button__icon">英語</span>
            </label>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    {{ Form::hidden('user_name', 'hoshino01') }}
    <button type="submit" class="btn">投稿</button>
    {!! Form::close() !!}
    <a href="{{ route('admin.list') }}">戻る</a>

@endsection
