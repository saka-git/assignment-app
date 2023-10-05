@extends('layouts.company.app')

@section('title', 'company応募 詳細')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


      <p>求人名</p>
      <a class="text-blue-500"
        href="{{ route('company.offer.show', $application->offer->id) }}">{{ $application->offer->name }}</a>

      <p>応募者</p>
      <p>{{ $application->user->name }}</p>

      <p>住所</p>
      <p>{{ $application->address }}</p>

      <p>電話番号</p>
      <p>{{ $application->phone }}</p>

      <p>メールアドレス</p>
      <p>{{ $application->user->email }}</p>

      <p>志望動機</p>
      <p>{!! nl2br($application->motivation) !!}</p>

      <p>メッセージ</p>


      <a class="text-red-500" href="{{ route('company.application.index') }}">戻る</a>

    </div>
  </div>
@endsection
