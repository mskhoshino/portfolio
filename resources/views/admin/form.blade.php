@extends('admin.layout')
@section('content')

      <div>
        <h2 class="title">管理画面 新規投稿</h2>
      </div>
      {!! Form::open(['route' => ['admin.register'], 'method' => 'post']) !!}
        <h3>カテゴリー</h3>
        <select name="category_id">
                <option value="">選択してください</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}" @if(old('category_id')==$category->category_id) selected  @endif>{{ $category->category_name }}</option>
            @endforeach
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span>
                    {{ $error }}
                    </span>
                @endforeach
            @endif
        </select>

        <h3>記事タイトル</h3>
            {!! Form::text('title', old('title'), ['class' => 'form-control', 'style' => 'min-width: 365px;']) !!}
        <h3>投稿内容</h3>
            {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
        <h3>言語</h3>
            <label class="radio-button">
                {{ Form::radio('language_type', '0', old("language_type")) }}
                <span class="radio-button__icon">中国語</span>
            </label>
            <label class="radio-button">
                {{ Form::radio('language_type', '1', old("language_type")) }}
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
    <a href="{{ route('admin.top') }}">戻る</a>

@endsection
