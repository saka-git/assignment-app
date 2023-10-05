@extends('layouts.user.app')


@section('title', 'User 応募 新規作成')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('application.store') }}" method="POST">
        @csrf

        <input type="hidden" name="offer_id" value="{{ $offer_id }}">

        <label for="address">住所</label>
        <input type="tel" id="address" name="address" value="{{ old('address') }}" class="w-full">

        <label for="phone">電話番号</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full">

        <label for="motivation">志望動機</label>
        <textarea name="motivation" id="motivation" cols="40" rows="10" class="w-full">{{ old('motivation') }}</textarea>

        <button class="text-blue-500" type="submit">応募</button>

        <a class="text-red-500" href="{{ route('application.index') }}">戻る</a>
      </form>
    </div>
  </div>
@endsection
