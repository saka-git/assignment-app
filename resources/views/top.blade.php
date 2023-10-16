<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 antialiased font-sans">

  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-xl shadow-md">
      <div>
        <h1 class="text-center text-2xl font-extrabold text-gray-900">トップ</h1>
      </div>
      <div class="rounded-lg bg-gray-50 p-4">
        <h2 class="text-xl font-bold text-gray-700 mb-4">応募者</h2>
        <div class="space-x-4">
          <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">ログイン</a>
          <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500">新規登録</a>
        </div>
      </div>
      <div class="rounded-lg bg-gray-50 p-4">
        <h2 class="text-xl font-bold text-gray-700 mb-4">企業</h2>
        <div class="space-x-4">
          <a href="{{ route('company.login') }}" class="text-indigo-600 hover:text-indigo-500">ログイン</a>
          <a href="{{ route('company.register') }}" class="text-indigo-600 hover:text-indigo-500">新規登録</a>
        </div>
      </div>
      <div class="rounded-lg bg-gray-50 p-4">
        <h2 class="text-xl font-bold text-gray-700 mb-4">管理者</h2>
        <div class="space-x-4">
          <a href="{{ route('admin.login') }}" class="text-indigo-600 hover:text-indigo-500">ログイン</a>
          <a href="{{ route('admin.register') }}" class="text-indigo-600 hover:text-indigo-500">新規登録</a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
