@extends('layouts.user.app')

@section('title', 'user業界一覧 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


      <p>求人名</p>
      <p>{{ $offer->name }}</p>

      <p>会社名</p>
      <p>{{ $offer->company->name }}</p>

      <p>職務内容</p>
      <p>{!! nl2br($offer->description) !!}</p>

      <p>応募資格</p>
      <p>{!! nl2br($offer->requirements) !!}</p>

      <p>福利厚生</p>
      <p>{!! nl2br($offer->benefits) !!}</p>

      <legend>特徴</legend>
      @foreach ($offer->features as $feature)
        <p>{{ $feature->name }}</p>
      @endforeach

      <a class="text-blue-500" href="">応募</a>

      <a class="text-red-500" href="{{ route('offer.index') }}">戻る</a>

    </div>
  </div>
@endsection
