@extends('layouts.admin.app')

@section('title', 'admin業界一覧 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('admin.offer.update', $offer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">求人名</label>
        <input type="text" name="name" id="name" value="{{ old('name', $offer->name) }}" class="w-full">

        <label for="description">職務内容</label>
        <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $offer->description) }}</textarea>

        <label for="requirements">応募資格</label>
        <textarea name="requirements" id="requirements" cols="30" rows="10">{{ old('requirements', $offer->requirements) }}</textarea>

        <label for="benefits">福利厚生</label>
        <textarea name="benefits" id="benefits" cols="30" rows="10">{{ old('benefits', $offer->benefits) }}</textarea>

        <legend>特徴</legend>
        @foreach ($features as $feature)
          <input type="checkbox" name="feature[]" value="{{ $feature->id }}" id="feature-{{ $feature->id }}"
            {{ in_array($feature->id, $offer->features->pluck('id')->toArray()) ? 'checked' : '' }}>
          <label for="feature-{{ $feature->id }}">{{ $feature->name }}</label>
        @endforeach

        <button class="text-blue-500" type="submit">更新</button>
        <a class="text-red-500" href="{{ route('admin.offer.index') }}">戻る</a>

      </form>
    </div>
  </div>
@endsection
