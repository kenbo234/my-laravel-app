@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>レビュー</h1>
        <form action="{{ route('site_reviews.store') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="form-group">
              <label for="tag_id">タグ</label>
              <select name="tag_id" id="tag_id" class="form-control">
                  <option value="">任意で選択してください</option>
                  @foreach($tags as $tag)
                      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
@endsection