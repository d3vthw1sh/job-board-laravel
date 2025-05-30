<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel Job Board</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="from-10% via-30% to-90% mx-auto mt-10 max-w-2xl bg-[#121620] text-white">

  <nav class="mb-8 flex items-center justify-between px-6 py-4 rounded-lg bg-[#181c27] shadow-sm border border-[#23283a]">
    <!-- Left Side: Logo (1.5x bigger) -->
    <ul class="flex items-center space-x-4">
      <li>
        <a href="{{ route('jobs.index') }}" class="flex items-center">
          <img src="{{ asset('logo.png') }}" alt="JobJik Logo" class="h-24 w-auto mr-2" />
        </a>
      </li>
    </ul>

    <!-- Right Side: Auth & Links -->
    <ul class="flex items-center space-x-6">
      @auth
        <li>
          <span class="px-3 py-1 rounded-full bg-gray-800 font-semibold text-white">
            {{ auth()->user()->name ?? 'Anonymous' }}
          </span>
        </li>
        <li>
          <a href="{{ route('my-job-applications.index') }}" class="text-gray-300 hover:text-[#01C38D] transition-colors">
            Applications
          </a>
        </li>
        <li>
          <a href="{{ route('my-jobs.index') }}" class="text-gray-300 hover:text-[#01C38D] transition-colors">
            My Jobs
          </a>
        </li>
        <li>
          <form action="{{ route('auth.destroy') }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="ml-2 text-red-400 hover:text-red-500 transition-colors font-semibold">Logout</button>
          </form>
        </li>
      @else
        <li>
          <a href="{{ route('auth.create') }}" class="px-4 py-1 rounded-md bg-[#01C38D] text-gray-900 font-semibold hover:bg-[#019d6f] transition-colors">
            Sign in
          </a>
        </li>
      @endauth
    </ul>
  </nav>

  @if (session('success'))
    <div role="alert"
      class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
      <p class="font-bold">Success!</p>
      <p>{{ session('success') }}</p>
    </div>
  @endif
  @if (session('error'))
    <div role="alert"
      class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
      <p class="font-bold">Error!</p>
      <p>{{ session('error') }}</p>
    </div>
  @endif

  {{ $slot }}
</body>
</html>
