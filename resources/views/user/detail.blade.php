@extends('user.layout')
@section('content')

    <div class="detail_category">
        @if($content->language_type == '0')
            <p>中国語
        @elseif($content->language_type == '1')
            <p>英語
        @endif
        @foreach($categories as $category)
            @if($content->category_id === $category->category_id)
                / {{ $category->category_name }} </p>
            @endif
        @endforeach
    </div>

    <div class="detail_title">
        {!! nl2br(e($content->title)) !!}
    </div>

    <div class="detail_content">
        {!! nl2br(e($content->content)) !!}
    </div>
    <div class="return_btn">
        <a href="{{ route('user.list') }}">記事一覧に戻る</a>
    </div>
    

@endsection