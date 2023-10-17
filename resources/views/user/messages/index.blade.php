@extends('layouts.user.app')

@section('title', 'user メッセージ')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">

      <!-- サイドバー：企業リスト -->
      <div class="flex-none w-1/4 p-4 bg-gray-100 border-r border-gray-200">
        <h4 class="mb-4 text-xl font-semibold">やり取りした企業</h4>
        <ul>
          @foreach ($companies as $comp)
            <li class="mb-3">
              <a href="{{ route('messages.show', $comp->id) }}"
                class="block p-2 text-gray-700 rounded hover:bg-gray-200 transition">
                {{ $comp->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- メインコンテンツ：選択された企業とのメッセージ履歴 -->
      <div class="flex-grow p-4 ml-4">
        @if (session('error'))
          <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            {{ session('error') }}
          </div>
        @endif

        <p class="mb-4 font-semibold text-lg">応募した企業にメッセージを送る</p>
        <div class="space-y-2">
          @foreach ($appliedCompanies as $appliedCompany)
            <a href="{{ route('messages.show', $appliedCompany->id) }}"
              class="inline-block p-2 text-blue-600 hover:underline">
              {{ $appliedCompany->name }}
            </a>
          @endforeach
        </div>
      </div>

    </div>
  </div>
@endsection
