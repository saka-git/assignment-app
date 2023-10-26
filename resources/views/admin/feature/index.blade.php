@extends('layouts.admin.app')


@section('title', 'Admin特徴一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      @if (session('success'))
        <div class="bg-blue-500 text-white p-4 rounded-md mb-6">
          {{ session('success') }}
        </div>
      @endif
      <a class="text-blue-500" href="{{ route('admin.feature.create') }}">新規</a>
      @foreach ($features as $feature)
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
          <h1 class="grid-span-4">{{ $feature->name }}</h1>

          <a class="text-blue-500" href="{{ route('admin.feature.edit', $feature->id) }}">編集</a>

          <form action="{{ route('admin.feature.destroy', $feature->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">削除</button>
          </form>

        </div>
      @endforeach
    </div>
  </div>
@endsection
