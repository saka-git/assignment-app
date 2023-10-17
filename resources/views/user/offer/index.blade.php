@extends('layouts.user.app')

@section('title', 'user 求人一覧')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded-lg shadow-md">
      <form action="{{ route('offer.index') }}" method="GET" class="mb-6">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">名前:</label>
          <input type="text" name="name" value="{{ request('name') }}" class="mt-1 p-2 w-full border rounded-md">
        </div>

        <div class="mb-4">
          <label for="company_name" class="block text-sm font-medium text-gray-700">会社名:</label>
          <input type="text" name="company_name" value="{{ request('company_name') }}"
            class="mt-1 p-2 w-full border rounded-md">
        </div>

        <fieldset class="mb-4">
          <legend class="text-sm font-medium text-gray-700 mb-2">業界:</legend>
          @foreach ($industries as $industry)
            <input type="checkbox" id="industry-{{ $industry->id }}" name="industries[]" value="{{ $industry->id }}"
              @if (in_array($industry->id, request('industries', []))) checked @endif>
            <label for="industry-{{ $industry->id }}" class="ml-2 mr-4">{{ $industry->name }}</label>
          @endforeach
        </fieldset>

        <fieldset class="mb-4">
          <legend class="text-sm font-medium text-gray-700 mb-2">特徴:</legend>
          @foreach ($features as $feature)
            <input type="checkbox" id="feature-{{ $feature->id }}" name="features[]" value="{{ $feature->id }}"
              @if (in_array($feature->id, request('features', []))) checked @endif>
            <label for="feature-{{ $feature->id }}" class="ml-2 mr-4">{{ $feature->name }}</label>
          @endforeach
        </fieldset>

        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none"
          type="submit">検索</button>
      </form>

      @foreach ($offers as $offer)
        <div class="mb-4 p-4 border rounded-lg">
          <div class="mb-2">
            <span class="text-gray-600 font-medium">会社名:</span>
            <h1>{{ $offer->company->name }}</h1>
          </div>

          <div class="mb-2">
            <span class="text-gray-600 font-medium">求人名:</span>
            <h1>{{ $offer->name }}</h1>
          </div>

          <a href="{{ route('offer.show', $offer->id) }}" class="text-green-500 hover:underline">詳細</a>
        </div>
      @endforeach

      <div class="mt-4">
        {{ $offers->appends(request()->query())->links() }}
      </div>
    </div>
  </div>
@endsection
