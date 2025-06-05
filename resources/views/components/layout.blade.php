<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Laravel Job Board</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- If Alpine.js isn't already loaded elsewhere, uncomment the next line -->
  <!-- <script src="//unpkg.com/alpinejs" defer></script> -->
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

      <!-- Right: User Dropdown or Sign in -->
      <div class="flex items-center gap-3">
        @auth
          <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
              class="bg-[#23283a] px-4 py-1 rounded-full font-semibold text-white shadow-inner text-sm min-w-0 max-w-[180px] truncate flex items-center gap-1"
              title="{{ auth()->user()->name }}">
              <span class="truncate min-w-0">{{ auth()->user()->name ?? 'Anonymous' }}</span>
              <svg class="w-4 h-4 ml-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div
              x-show="open"
              @click.away="open = false"
              x-transition
              class="absolute right-0 mt-2 w-44 rounded-md bg-[#181c27] border border-[#23283a] shadow-lg z-50 py-1"
              style="display: none;"
            >
              @if(auth()->user()->is_admin)
                <a href="{{ route('admin.jobs.index') }}" class="block px-4 py-2 text-sm text-[#01C38D] hover:bg-[#23283a]">Admin Panel</a>
              @endif
              <form action="{{ route('auth.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-[#23283a]">Logout</button>
              </form>
            </div>
          </div>
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
