@extends('layouts.user.app')

@section('title', 'User 応募 新規作成')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow-md">

      @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-md mb-6">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('application.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="offer_id" value="{{ $offer_id }}">

        <div>
          <label for="address" class="text-gray-600 block mb-2">住所</label>
          <input type="tel" id="address" name="address" value="{{ old('address') }}"
            class="w-full border rounded p-2">
        </div>

        <div>
          <label for="phone" class="text-gray-600 block mb-2">電話番号</label>
          <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
            class="w-full border rounded p-2">
        </div>

        <div>
          <label for="motivation" class="text-gray-600 block mb-2">志望動機</label>
          <textarea name="motivation" id="motivation" cols="40" rows="10" class="w-full border rounded p-2">{{ old('motivation') }}</textarea>
        </div>

        <div class="flex items-center space-x-4">
          <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none"
            type="submit">応募</button>
          <a href="{{ route('application.index') }}" class="text-red-500 hover:underline">戻る</a>
        </div>
      </form>
    </div>
  </div>
@endsection
