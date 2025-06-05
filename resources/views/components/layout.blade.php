<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel Job Board</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#121620] text-white">

  <!-- Professional Navbar -->
  <nav class="sticky top-0 z-50 w-full bg-[#181c27]/95 shadow-xl border-b border-[#23283a] backdrop-blur">
    <div class="w-full flex items-center justify-between px-4 md:px-10 py-3">

      <!-- Left: Brand/Logo -->
      <a href="{{ url('/welcome') }}" class="flex items-center gap-2 select-none group">
        <svg class="w-8 h-8 text-[#01C38D] group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke="#01C38D" stroke-width="2" />
        </svg>
        <span class="text-[#01C38D] font-extrabold text-2xl md:text-3xl tracking-wider group-hover:text-white transition">JOBPADOY</span>
      </a>

      <!-- Center: Navigation Links -->
      <div class="flex-1 flex items-center justify-center gap-6">
        <a href="{{ route('jobs.index') }}" class="px-3 py-2 rounded-lg text-base font-medium hover:bg-[#23283a] hover:text-[#01C38D] focus-visible:outline-none transition @if(request()->routeIs('jobs.index')) bg-[#23283a] text-[#01C38D] font-semibold @endif">Jobs</a>
        @auth
        <a href="{{ route('my-job-applications.index') }}" class="px-3 py-2 rounded-lg text-base font-medium hover:bg-[#23283a] hover:text-[#01C38D] focus-visible:outline-none transition @if(request()->routeIs('my-job-applications.index')) bg-[#23283a] text-[#01C38D] font-semibold @endif">Applications</a>
        <a href="{{ route('my-jobs.index') }}" class="px-3 py-2 rounded-lg text-base font-medium hover:bg-[#23283a] hover:text-[#01C38D] focus-visible:outline-none transition @if(request()->routeIs('my-jobs.index')) bg-[#23283a] text-[#01C38D] font-semibold @endif">My Jobs</a>
        @endauth
      </div>

      <!-- Right: User/Logout/Sign in -->
      <div class="flex items-center gap-3">
        @auth
          <span class="bg-[#23283a] px-4 py-1 rounded-full font-semibold text-white shadow-inner text-sm max-w-[130px] truncate" title="{{ auth()->user()->name }}">
            {{ auth()->user()->name ?? 'Anonymous' }}
          </span>
          <form action="{{ route('auth.destroy') }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="ml-2 px-3 py-1 rounded-md bg-red-500/20 text-red-400 hover:bg-red-600/50 hover:text-white font-semibold transition focus-visible:outline-none">Logout</button>
          </form>
        @else
          <a href="{{ route('signin') }}" class="px-5 py-1.5 rounded-lg bg-[#01C38D] text-gray-900 font-bold shadow hover:bg-[#019d6f] transition focus-visible:outline-none">
            Sign in
          </a>
        @endauth
      </div>
    </div>
  </nav>

  <!-- Main content area -->
  <main class="mx-auto mt-10 max-w-2xl px-4">
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
  </main>
</body>
</html>
