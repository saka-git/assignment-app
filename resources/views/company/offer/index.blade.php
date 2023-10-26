@extends('layouts.company.app')


@section('title', 'Company 求人一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      @if (session('success'))
        <div class="bg-blue-500 text-white p-4 rounded-md mb-6">
          {{ session('success') }}
        </div>
      @endif
      <a class="text-blue-500" href="{{ route('company.offer.create') }}">新規</a>
      @foreach ($offers as $offer)
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
          <h1 class="grid-span-4">{{ $offer->name }}</h1>

          <a class="text-green-500" href="{{ route('company.offer.show', $offer->id) }}">詳細</a>

          <a class="text-blue-500" href="{{ route('company.offer.edit', $offer->id) }}">編集</a>

          <form action="{{ route('company.offer.destroy', $offer->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">削除</button>
          </form>

        </div>
      @endforeach
      {{ $offers->links() }}

    </div>
  </div>
@endsection
