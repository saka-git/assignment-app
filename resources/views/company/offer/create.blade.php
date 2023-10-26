@extends('layouts.company.app')


@section('title', 'company求人一覧 新規作成')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-md mb-6">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ route('company.offer.store') }}" method="POST">
        @csrf

        <label for="name">求人名</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="" class="w-full">
        <label for="description">職務内容</label>
        <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        <label for="requirements">応募資格</label>
        <textarea name="requirements" id="requirements" cols="30" rows="10">{{ old('requirements') }}</textarea>
        <label for="benefits">福利厚生</label>
        <textarea name="benefits" id="benefits" cols="30" rows="10">{{ old('benefits') }}</textarea>
        <legend>特徴</legend>
        @foreach ($features as $feature)
          <input type="checkbox" name="feature[]" value="{{ $feature->id }}" id="feature-{{ $feature->id }}">
          <label for="feature-{{ $feature->id }}">{{ $feature->name }}</label>
        @endforeach
        <button class="text-blue-500" type="submit">登録</button>

        <a class="text-red-500" href="{{ route('company.offer.index') }}">戻る</a>
      </form>
    </div>
  </div>
@endsection
