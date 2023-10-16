@extends('layouts.company.app')


@section('title', 'company メッセージ')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">

      <!-- サイドバー：応募者メッセージリスト -->
      <div class="flex-none w-1/4 p-4 bg-gray-100">
        <h4 class="mb-4">応募者</h4>
        <ul class="list-group">
          @foreach ($users as $individual)
            <li class="p-2 mb-2 rounded">
              <a href="{{ route('company.messages.show', $individual->id) }}" class="block hover:text-gray-500">
                {{ $individual->name }}
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

        <p>応募者にメッセージを送る</p>
      </div>

    </div>
  </div>
@endsection
