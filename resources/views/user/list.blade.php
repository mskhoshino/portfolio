@extends('user.layout')
@section('content')

<div class="search">
  <h3 class="search_contents">記事検索</h3>
  {!! Form::open(['route' => ['user.search'], 'method' => 'post']) !!}
  <p class="search-section">カテゴリーで検索</p>
  <select name="search_category_id" class="search-select">
        <option value="">選択してください</option>
    @foreach($categories as $category)
        <option value="{{ $category->category_id }}" @if(old('category_id')==$category->category_id) selected  @endif>{{ $category->category_name }}</option>
    @endforeach
  </select>

  <p class="search-section">言語タイプで検索</p>
  <select class="search-select search_language_type" name="search_language_type" id="search_language_type">
      <option value="">選択してください</option>
    @foreach($language_type as $key => $value)
      <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
  </select>
  <p class="search-section">キーワードで検索</p>
  <input type="text" name="search_text" rows="5" cols="100" class="search_text" value=""><?php $search_text ?></input>
  <button type="submit" class="search_btn">検索</button>
  {!! Form::close() !!}
</div>

<div class="list">
  <h3 class="list_contents">記事一覧</h3>
  @foreach($contents as $key=>$content)
  <table class="table">
      <tbody>
        <tr>
            <td class="align-middle">{{ $key+1 }}</td>
            <td class="align-middle content_category">
              @if($content->language_type === 0)
              中国語
              @elseif($content->language_type === 1)
              英語
              @endif
            @foreach($categories as $category)
            @if($content->category_id === $category->category_id)
              / {{ $category->category_name }}
            </td>
            @endif
            @endforeach
        </tr>
      </tbody>
  </table>
  <div class="content_title">
    <a href="{{ route('user.detail', $content->id) }}">{{ $content->title }}</a>
  </div>
  <div class="content_summary">
    <a><?php echo mb_strimwidth($content->content, 0, 250, "...", 'UTF-8'); ?></a>
  </div>
  @endforeach
  @if(! empty($messages))
    @foreach($messages as $item => $message)
      <p class="error_message">{{ $item == 'search' ? $message : '' }}</p>
    @endforeach
  @endif
</div>

@endsection