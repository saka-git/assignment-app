@extends('layouts.admin.app')

@section('title', 'admin業界一覧 編集')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


      <p>会社名</p>
      <p>{{ $company->name }}</p>

      <legend>業界</legend>
      @foreach ($company->industries as $industry)
        <p>{{ $industry->name }}</p>
      @endforeach

      <a class="text-red-500" href="{{ route('admin.company.index') }}">戻る</a>

    </div>
  </div>
@endsection
