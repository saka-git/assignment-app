@extends('layouts.user.app')

@section('title', 'user 応募 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('application.update', $application->id) }}" method="POST"
        class="bg-white p-6 shadow-md rounded-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
          <p class="text-sm font-semibold text-gray-600">会社名</p>
          <p class="text-lg">{{ $application->offer->company->name }}</p>
        </div>

        <div class="mb-4">
          <label for="name" class="block text-sm font-semibold text-gray-600">求人名</label>
          <p class="text-lg">{{ $application->offer->name }}</p>
        </div>

        <div class="mb-4">
          <label for="address" class="block text-sm font-semibold text-gray-600">住所</label>
          <input type="tel" id="address" name="address" value="{{ old('address', $application->address) }}"
            class="w-full p-2 border rounded-lg">
        </div>

        <div class="mb-4">
          <label for="phone" class="block text-sm font-semibold text-gray-600">電話番号</label>
          <input type="text" id="phone" name="phone" value="{{ old('phone', $application->phone) }}"
            class="w-full p-2 border rounded-lg">
        </div>

        <div class="mb-4">
          <label for="motivation" class="block text-sm font-semibold text-gray-600">志望動機</label>
          <textarea name="motivation" id="motivation" cols="40" rows="10" class="w-full p-2 border rounded-lg">{{ old('motivation', $application->motivation) }}</textarea>
        </div>

        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" type="submit">更新</button>
          <a class="text-red-500 hover:underline" href="{{ route('application.index') }}">戻る</a>
        </div>
      </form>
    </div>
  </div>
@endsection
