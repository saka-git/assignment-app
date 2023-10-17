@extends('layouts.admin.app')


@section('title', 'Admin 求人一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      <form action="{{ route('admin.company.index') }}" method="GET">
        @csrf

        <label for="name">会社名:</label>
        <input type="text" name="name" value="{{ request('name') }}">

        <legend>業界:</legend>
        @foreach ($industries as $industry)
          <input type="checkbox" name="industries[]" value="{{ $industry->id }}"
            @if (in_array($industry->id, request('industries', []))) checked @endif>
          <label for="industry-{{ $industry->id }}">{{ $industry->name }}</label>
        @endforeach

        <button class="text-blue-500" type="submit">検索</button>
      </form>
      @foreach ($companies as $company)
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
          <h1 class="grid-span-4">{{ $company->name }}</h1>

          <a class="text-green-500" href="{{ route('admin.company.show', $company->id) }}">詳細</a>

          <a class="text-blue-500" href="{{ route('admin.company.edit', $company->id) }}">編集</a>

          <form action="{{ route('admin.company.destroy', $company->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">削除</button>
          </form>

        </div>
      @endforeach
      {{ $companies->appends(request()->query())->links() }}
    </div>
  </div>
@endsection
