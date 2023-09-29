@extends('layouts.admin.app')


@section('title', 'Admin特徴一覧 新規作成')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('admin.feature.store') }}" method="POST">
        @csrf

        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="特徴" class="w-full">

        <button type="submit" class="text-blue-500">登録</button>

        <a class="text-red-500" href="{{ route('admin.feature.index') }}">戻る</a>
    </div>
    </form>
  </div>
  </div>
@endsection
