@extends('layouts.company.app')

@section('title', 'company業界一覧 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


      <label for="name">求人名</label>
      <p>{{ $offer->name }}</p>

      <label for="description">職務内容</label>
      <p>{!! nl2br($offer->description) !!}</p>

      <label for="requirements">応募資格</label>
      <p>{!! nl2br($offer->requirements) !!}</p>

      <label for="benefits">福利厚生</label>
      <p>{!! nl2br($offer->benefits) !!}</p>

      <legend>特徴</legend>
      @foreach ($offer->features as $feature)
        <p>{{ $feature->name }}</p>
      @endforeach

      <a class="text-red-500" href="{{ route('company.offer.index') }}">戻る</a>

    </div>
  </div>
@endsection
