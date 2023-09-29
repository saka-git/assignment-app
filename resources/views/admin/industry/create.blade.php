@extends('layouts.admin.app')


@section('title', 'Admin業界一覧 新規作成')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('admin.industry.store') }}" method="POST">
        @csrf

        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="業界名" class="w-full">

        <button type="submit">登録</button>

        <a href="{{ route('admin.industry.index') }}">戻る</a>
    </div>
    </form>
  </div>
  </div>
@endsection
