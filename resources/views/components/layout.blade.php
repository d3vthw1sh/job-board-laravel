<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel Job Board</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="mx-auto mt-10 max-w-2xl bg-[#121620] text-white">

  <nav class="mb-8 px-6 py-3 rounded-xl bg-[#181c27] shadow-sm border border-[#23283a]">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <!-- Left: Brand -->
      <a href="{{ url('/welcome') }}" class="flex items-center gap-2 select-none">
        <span class="text-[#01C38D] font-extrabold text-3xl tracking-wide">JOBJIK</span>
      </a>

      @auth
      <!-- Center: Icon Navigation -->
      <div class="flex items-center gap-8">
        <a href="{{ route('my-job-applications.index') }}"
           class="flex flex-col items-center group px-1 focus:outline-none"
           title="Applications">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-0.5 group-hover:text-[#01C38D] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <title>Applications</title>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2M3 10h18M5 10v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V10" />
          </svg>
          <span class="text-xs text-white group-hover:text-[#01C38D] transition select-none">Applications</span>
        </a>
        <a href="{{ route('my-jobs.index') }}"
           class="flex flex-col items-center group px-1 focus:outline-none"
           title="My Jobs">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-0.5 group-hover:text-[#01C38D] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <title>My Jobs</title>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 3h6v4H9V3zm0 8h6m-6 4h6" />
          </svg>
          <span class="text-xs text-white group-hover:text-[#01C38D] transition select-none">My Jobs</span>
        </a>
      </div>
      @endauth

      <!-- Right: User/Logout -->
      <div class="flex items-center gap-3">
        @auth
          <span class="bg-[#23283a] px-3 py-1 rounded-full font-semibold text-white truncate max-w-[110px] shadow-inner text-sm" title="{{ auth()->user()->name }}">
            {{ auth()->user()->name ?? 'Anonymous' }}
          </span>
          <form action="{{ route('auth.destroy') }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="ml-2 text-red-400 hover:text-red-500 transition font-semibold">Logout</button>
          </form>
        @else
          <a href="{{ route('signin') }}" class="px-4 py-1 rounded-md bg-[#01C38D] text-gray-900 font-semibold hover:bg-[#019d6f] transition">
            Sign in
          </a>
        @endauth
      </div>
    </div>
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
