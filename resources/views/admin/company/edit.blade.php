@extends('layouts.admin.app')

@section('title', 'admin業界一覧 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('admin.company.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">会社名</label>
        <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" class="w-full">


        <legend>業界</legend>
        @foreach ($industries as $industry)
          <input type="checkbox" name="industry[]" value="{{ $industry->id }}" id="industry-{{ $industry->id }}"
            {{ in_array($industry->id, $company->industries->pluck('id')->toArray()) ? 'checked' : '' }}>
          <label for="industry-{{ $industry->id }}">{{ $industry->name }}</label>
        @endforeach

        <button class="text-blue-500" type="submit">更新</button>
        <a class="text-red-500" href="{{ route('admin.company.index') }}">戻る</a>

      </form>
    </div>
  </div>
@endsection
