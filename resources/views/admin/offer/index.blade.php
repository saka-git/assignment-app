@extends('layouts.admin.app')


@section('title', 'Admin 求人一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      <form action="{{ route('admin.offer.index') }}" method="GET">
        <label for="name">名前:</label>
        <input type="text" name="name" value="{{ request('name') }}">

        <label for="company_name">会社名:</label>
        <input type="text" name="company_name" value="{{ request('company_name') }}">

        <legend>業界:</legend>
        @foreach ($industries as $industry)
          <input type="checkbox" name="industries[]" value="{{ $industry->id }}"
            @if (in_array($industry->id, request('industries', []))) checked @endif>
          <label for="industry-{{ $industry->id }}">{{ $industry->name }}</label>
        @endforeach

        <legend>特徴:</legend>
        @foreach ($features as $feature)
          <input type="checkbox" name="features[]" value="{{ $feature->id }}"
            @if (in_array($feature->id, request('features', []))) checked @endif>
          <label for="feature-{{ $feature->id }}">{{ $feature->name }}</label>
        @endforeach

        <button class="text-blue-500" type="submit">検索</button>
      </form>
      @foreach ($offers as $offer)
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
          <h1 class="grid-span-4">{{ $offer->name }}</h1>

          <a class="text-green-500" href="{{ route('admin.offer.show', $offer->id) }}">詳細</a>

          <a class="text-blue-500" href="{{ route('admin.offer.edit', $offer->id) }}">編集</a>

          <form action="{{ route('admin.offer.destroy', $offer->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">削除</button>
          </form>

        </div>
      @endforeach
      {{ $offers->appends(request()->query())->links() }}
    </div>
  </div>
@endsection
