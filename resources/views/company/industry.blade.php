@extends('layouts.company.app')


@section('title', 'Company 業界選択')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if (session('success'))
        <div class="">
          {{ session('success') }}
        </div>
      @endif
      <form action="{{ route('company.industry.store') }}" method="POST">
        @csrf

        @foreach ($industries as $industry)
          <input type="checkbox" name="industry[]" value="{{ $industry->id }}" id="industry-{{ $industry->id }}"
            {{ in_array($industry->id,auth('company')->user()->industries->pluck('id')->toArray())? 'checked': '' }}>
          <label for="industry-{{ $industry->id }}">{{ $industry->name }}</label>
        @endforeach

        <button class="text-blue-500" type="submit">登録</button>

        <a class="text-red-500" href="">戻る</a>
      </form>
    </div>
  </div>
@endsection
