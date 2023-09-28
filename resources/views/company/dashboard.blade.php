@extends('layouts.company.app')


@section('title', 'Companyのダッシュボード')


@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <h1>Companyのダッシュボード</h1>
          {{ __("You're logged in!") }}

          <div>{{ Auth::guard('company')->user()->name }}</div>

        </div>
      </div>
    </div>
  </div>
@endsection
