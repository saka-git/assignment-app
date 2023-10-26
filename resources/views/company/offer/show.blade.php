@extends('layouts.company.app')

@section('title', 'company求人 詳細')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      @if (session('success'))
        <div class="bg-blue-500 text-white p-4 rounded-md mb-6">
          {{ session('success') }}
        </div>
      @endif

      <p>求人名</p>
      <p>{{ $offer->name }}</p>

      <p>職務内容</p>
      <p>{!! nl2br($offer->description) !!}</p>

      <p>応募資格</p>
      <p>{!! nl2br($offer->requirements) !!}</p>

      <p>福利厚生</p>
      <p>{!! nl2br($offer->benefits) !!}</p>

      <p>特徴</p>
      @foreach ($offer->features as $feature)
        <p>{{ $feature->name }}</p>
      @endforeach

      <p>応募者</p>
      @foreach ($applications as $application)
        <a class="text-blue-500" href="{{ route('company.application.show', $application->id) }}">
          {{ $application->user->name }}
        </a>
      @endforeach

      <a class="text-red-500" href="{{ route('company.offer.index') }}">戻る</a>

    </div>
  </div>
@endsection
