@extends('layouts.company.app')


@section('title', 'company 応募一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      <form action="{{ route('company.application.index') }}" method="GET">
        @csrf
        <label for="name">応募者名:</label>
        <input type="text" name="name" value="{{ request('name') }}">

        <label for="offer">求人:</label>
        <select name="offer" id="offer">
          <option value="">選択してください</option>
          @foreach ($offers as $offer)
            <option value="{{ $offer->id }}" @if (request('offer') == $offer->id) selected @endif>
              {{ $offer->name }}</option>
          @endforeach
        </select>

        <button class="text-blue-500" type="submit">検索</button>
      </form>
      @foreach ($applications as $application)
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="flex">
            <p>求人名：</p>
            <h1 class="grid-span-4">{{ $application->offer->name }}</h1>
          </div>

          <div class="flex">
            <p>応募者：</p>
            <h1 class="grid-span-4">{{ $application->user->name }}</h1>
          </div>

          <a class="text-green-500" href="{{ route('company.application.show', $application->id) }}">詳細</a>

        </div>
      @endforeach
      {{ $applications->appends(request()->query())->links() }}
    </div>
  </div>
@endsection
