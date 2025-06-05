<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - JOBPADOY</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#11171e] text-white">

    <!-- Admin Navbar -->
    <nav class="sticky top-0 z-50 w-full bg-[#242b39] shadow-xl border-b border-[#23283a] backdrop-blur">
        <div class="w-full flex items-center justify-between px-4 md:px-10 py-3">
            <!-- Left: Admin Brand -->
            <a href="{{ route('admin.jobs.index') }}" class="flex items-center gap-2 select-none group">
                <svg class="w-7 h-7 text-[#01C38D] group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24">
                    <rect x="4" y="4" width="16" height="16" rx="4" stroke="#01C38D" stroke-width="2"/>
                </svg>
                <span class="text-[#01C38D] font-extrabold text-xl tracking-wider group-hover:text-white transition">
                    JOBPADOY ADMIN
                </span>
            </a>
            <!-- Right: Back to Site -->
            <div>
                <a href="{{ url('/') }}" class="text-gray-400 hover:text-white px-3 py-1 rounded transition">← Back to Site</a>
            </div>
        </div>
    </nav>

    <main class="mx-auto mt-10 max-w-3xl px-4">
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
