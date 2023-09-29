@extends('layouts.admin.app')


@section('title', 'Admin業界一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      <a class="text-blue-500" href="{{ route('admin.industry.create') }}">新規</a>
      @foreach ($industries as $industry)
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
          <h1 class="grid-span-4">{{ $industry->name }}</h1>

          <a class="text-blue-500" href="{{ route('admin.industry.edit', $industry->id) }}">編集</a>

          <form action="{{ route('admin.industry.destroy', $industry->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">削除</button>
          </form>

        </div>
      @endforeach
    </div>
  </div>
@endsection
