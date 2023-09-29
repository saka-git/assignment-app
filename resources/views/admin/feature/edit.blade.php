@extends('layouts.admin.app')


@section('title', 'Admin特徴一覧 編集')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('admin.feature.update', $feature->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" id="name" value="{{ old('name', $feature->name) }}" placeholder="業界名"
          class="w-full">

        <button class="text-blue-500" type="submit">更新</button>

        <a class="text-red-500" href="{{ route('admin.feature.index') }}">戻る</a>
    </div>
  </div>
@endsection
