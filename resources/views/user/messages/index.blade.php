@extends('layouts.user.app')


@section('title', 'user メッセージ')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">

      <!-- サイドバー：企業リスト -->
      <div class="flex-none w-1/4 p-4 bg-gray-100">
        <h4 class="mb-4">Companies</h4>
        <ul class="list-group">
          @foreach ($companies as $comp)
            <li class="p-2 mb-2 rounded">
              <a href="{{ route('messages.show', $comp->id) }}" class="block hover:text-gray-500">
                {{ $comp->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- メインコンテンツ：選択された企業とのメッセージ履歴 -->
      <div class="flex-grow p-4">
        @if (session('error'))
          <div class="bg-red-500 text-white p-4 rounded-md mb-2 mt-4">
            {{ session('error') }}
          </div>
        @endif

        <p>応募した企業にメッセージを送る</p>
      </div>

    </div>
  </div>
@endsection
