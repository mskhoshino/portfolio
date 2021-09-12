@extends('admin.layout')
@section('content')

        <h2 class="title">管理画面 記事一覧</h2>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th class="number">連番</th>
                <th class="category_name">カテゴリー</th>
                <th class="title">タイトル</th>
                <th class="content">記事</th>
                <th class="language_type">言語</th>
                <th class="update_at">更新日</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contents as $key=>$content)
            <tr>
                <td class="align-middle"><a href="{{ route('admin.edit', $content->id) }}">{{ $key+1 }}</a></td>
                @foreach($categories as $category)
                @if($content->category_id === $category->category_id)
                <td class="align-middle">
                  {{ $category->category_name }}
                </td>
                @endif
                @endforeach
                <td class="align-middle">{{ $content->title }}</td>
                <td class="align-middle">{{ $content->content }}</td>
                <td class="align-middle summary">
                  @if($content->language_type === 0)
                  中国語
                  @elseif($content->language_type === 1)
                  英語
                  @endif
                </td>
                @if(!is_null($content->create_at))
                <td class="align-middle summary">
                  {{ $content->create_at }}
                </td>
                @else
                <td class="align-middle summary">
                  {{ $content->update_at }}
                </td>
                @endif
                <td>
                  <a href="{{ route('admin.detail', $content->id) }}">削除</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.top') }}">戻る</a>

@endsection
