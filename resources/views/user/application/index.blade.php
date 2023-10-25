@extends('layouts.user.app')

@section('title', 'user 応募一覧')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

      @if (session('error'))
        <div class="text-red-500 mb-4 p-4 border border-red-600 bg-red-100 rounded">
          {{ session('error') }}
        </div>
      @endif

      @foreach ($applications as $application)
        <div class="p-6 text-gray-900 dark:text-gray-100 bg-white shadow-md rounded-lg mb-4">
          <div class="flex items-center mb-4">
            <div>
              <p class="text-sm font-semibold text-gray-600">会社名</p>
              <h1 class="text-xl font-bold">{{ $application->offer->company->name }}</h1>
            </div>
            <div class="ml-4">
              <p class="text-sm font-semibold text-gray-600">求人名</p>
              <h1 class="text-xl font-bold">{{ $application->offer->name }}</h1>
            </div>
          </div>
          <div class="flex space-x-4">
            <a class="text-green-500 hover:underline" href="{{ route('application.show', $application->id) }}">詳細</a>
            <a class="text-blue-500 hover:underline" href="{{ route('application.edit', $application->id) }}">編集</a>
            <form action="{{ route('application.destroy', $application->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="text-red-500 hover:underline" type="submit">削除</button>
            </form>
            <a class="text-purple-500 hover:underline"
              href="{{ route('messages.show', $application->offer->company_id) }}">メッセージ</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
