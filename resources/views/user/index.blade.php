@extends('user.layout')
@section('content')

<h2 class="title">翻訳</h2>
      {!! Form::open(['route' => 'user.translate', 'method' => 'post']) !!}
      <div>
        <select class="language_type" name="language_type_from" id="language_type language_type_from">
            <option value="">翻訳したい言語を選択してください</option>
            @foreach($language_type_pulldown as $key => $value)
              <option value="{{ $key }}" @if($key == $language_type_from) selected @endif>{{ $value }}</option>
            @endforeach
        </select>
        @if(! empty($messages))
          @foreach($messages as $item => $message)
            <p class="error_message">{{ $item == 'language_type' ? $message : '' }}</p>
          @endforeach
        @endif

        @if(isset($_POST["text"]))
        <textarea name="text" rows="5" cols="100" class="translate-text-box" value=""><?php echo $_POST["text"]; ?></textarea>
        @else
        <textarea name="text" rows="5" cols="100" class="translate-text-box" value=""><?php $text ?></textarea>
        @endif
        @if(! empty($messages))
          @foreach($messages as $item => $message)
            <p class="error_message">{{ $item == 'text' ? $message : '' }}</p>
          @endforeach
        @endif
        <button type="submit" class="translate-button">翻訳</button>
        @if(! empty($messages))
          @foreach($messages as $item => $message)
            <p class="error_message">{{ $item == 'text_and_language' ? $message : '' }}</p>
          @endforeach
        @endif
      </div>
      {!! Form::close() !!}
      <h3 class="sub_title">◼︎ 翻訳結果</h3>
      <div class="translate_result">
        <p class="result_language">{{ $translated_language_1 ?? '' }}<br></p>
        <p class="result_translated">{{ $posts_1['text'] ?? '' }}</p>
      </div>
      <div class="translate_result">
        <p class="result_language">{{ $translated_language_2 ?? '' }}<br></p>
        <p class="result_translated">{{ $posts_2['text'] ?? '' }}</p>
      </div>

@endsection