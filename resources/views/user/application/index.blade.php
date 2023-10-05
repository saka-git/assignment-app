@extends('layouts.user.app')


@section('title', 'user 応募一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

      @if (session('error'))
        <div class="text-red-500">
          {{ session('error') }}
        </div>
      @endif

      @foreach ($applications as $application)
        <div class="p-6 text-gray-900 dark:text-gray-100 flex">
          <h1 class="grid-span-4">{{ $application->offer->name }}</h1>

          <a class="text-green-500" href="{{ route('application.show', $application->id) }}">詳細</a>

          <a class="text-blue-500" href="{{ route('application.edit', $application->id) }}">編集</a>

          <form action="{{ route('application.destroy', $application->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500" type="submit">削除</button>
          </form>

        </div>
      @endforeach
    </div>
  </div>
@endsection
