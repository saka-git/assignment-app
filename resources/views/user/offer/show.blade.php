@extends('layouts.user.app')

@section('title', 'user業界一覧 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow-md">

      @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-6">
          {{ session('error') }}
        </div>
      @endif

      <div class="mb-4">
        <span class="text-gray-600 font-medium block">求人名:</span>
        <p class="text-lg mt-1">{{ $offer->name }}</p>
      </div>

      <div class="mb-4">
        <span class="text-gray-600 font-medium block">会社名:</span>
        <p class="text-lg mt-1">{{ $offer->company->name }}</p>
      </div>

      <div class="mb-4">
        <span class="text-gray-600 font-medium block">職務内容:</span>
        <p class="text-lg mt-1 whitespace-pre-line">{{ $offer->description }}</p>
      </div>

      <div class="mb-4">
        <span class="text-gray-600 font-medium block">応募資格:</span>
        <p class="text-lg mt-1 whitespace-pre-line">{{ $offer->requirements }}</p>
      </div>

      <div class="mb-4">
        <span class="text-gray-600 font-medium block">福利厚生:</span>
        <p class="text-lg mt-1 whitespace-pre-line">{{ $offer->benefits }}</p>
      </div>

      <div class="mb-4">
        <span class="text-gray-600 font-medium block">特徴:</span>
        <ul class="list-disc pl-5 mt-2">
          @foreach ($offer->features as $feature)
            <li class="mb-1">{{ $feature->name }}</li>
          @endforeach
        </ul>
      </div>

      <div class="flex items-center space-x-4">
        <a href="{{ route('application.create', $offer->id) }}"
          class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none">応募</a>
        <a href="{{ route('offer.index') }}" class="text-red-500 hover:underline">戻る</a>
      </div>

    </div>
  </div>
@endsection
