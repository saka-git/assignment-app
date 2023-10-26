@extends('layouts.user.app')

@section('title', 'user 応募詳細')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="p-6 text-gray-900 dark:text-gray-100 bg-white shadow-md rounded-lg">
        @if (session('success'))
          <div class="bg-blue-500 text-white p-4 rounded-md mb-6">
            {{ session('success') }}
          </div>
        @endif
        <div class="mb-4">
          <p class="text-sm font-semibold text-gray-600">会社名</p>
          <p class="text-lg">{{ $application->offer->company->name }}</p>
        </div>

        <div class="mb-4">
          <p class="text-sm font-semibold text-gray-600">求人名</p>
          <a class="text-lg text-blue-500 hover:underline"
            href="{{ route('offer.show', $application->offer->id) }}">{{ $application->offer->name }}</a>
        </div>

        <div class="mb-4">
          <p class="text-sm font-semibold text-gray-600">住所</p>
          <p class="text-lg">{{ $application->address }}</p>
        </div>

        <div class="mb-4">
          <p class="text-sm font-semibold text-gray-600">電話番号</p>
          <p class="text-lg">{{ $application->phone }}</p>
        </div>

        <div class="mb-4">
          <p class="text-sm font-semibold text-gray-600">志望動機</p>
          <p class="text-lg whitespace-pre-line">{{ $application->motivation }}</p>
        </div>

        <div class="mt-6">
          <a class="text-red-500 hover:underline" href="{{ route('application.index') }}">戻る</a>
        </div>
      </div>

    </div>
  </div>
@endsection
