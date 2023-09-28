@extends('layouts.company.app')


@section('title', 'Companyの切り替え')


@section('content')
  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    <h1>Company切り替え</h1>
    <form action="{{ route('company.link') }}" method="POST">
      @csrf

      <!-- Email Address -->
      <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
          autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
          autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-2 mt-4">
          {{ session('error') }}
        </div>
      @endif

      @if (session('success'))
        <div class="bg-cyan-400 text-white p-4 rounded-md mb-2 mt-4">
          {{ session('success') }}
        </div>
      @endif

      <x-primary-button class="mt-4">
        {{ __('追加') }}
      </x-primary-button>

    </form>
  </div>

@endsection
