@extends('layouts.company.app')


@section('title', 'company メッセージ 個別')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">

      <!-- サイドバー：企業リスト -->
      <div class="flex-none w-1/4 p-4 bg-gray-100">
        <h4 class="mb-4">Companies</h4>
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
        <h3 class="mb-4">{{ $user->name }}</h3>
        <div class="mb-4">
          @foreach ($messages as $message)
            <div
              class="border p-2 mb-2 {{ $message->sender_type == 'App\Models\Company' ? 'text-right bg-blue-100' : 'bg-green-100' }}">
              {!! nl2br($message->content) !!}
            </div>
          @endforeach
        </div>

        <form action="{{ route('company.messages.store', $user->id) }}" method="post" class="mt-4">
          @csrf
          <div class="form-group">
            <textarea name="content" class="form-control w-full p-2 border rounded" placeholder="Enter your message"></textarea>
          </div>
          <button type="submit" class="btn mt-2 bg-blue-500 text-white px-4 py-2 rounded">送信</button>
        </form>
      </div>

    </div>
  </div>
@endsection
