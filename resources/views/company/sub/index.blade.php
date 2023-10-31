@extends('layouts.company.app')


@section('title', 'Company アカウント一覧')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
      @if (session('success'))
        <div class="bg-blue-500 text-white p-4 rounded-md mb-6">
          {{ session('success') }}
        </div>
      @endif
      <a class="text-blue-500" href="{{ route('company.sub.create') }}">新規</a>


    </div>
  </div>
@endsection
