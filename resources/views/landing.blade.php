<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JobJik - Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body {
      font-family: 'Urbanist', ui-sans-serif, system-ui, sans-serif;
    }
  </style>
</head>
<body class="bg-[#121620] text-white min-h-screen flex flex-col">

  <!-- Navbar (no logo, just text name) -->
  <nav class="w-full bg-[#181c27] border-b border-[#23283a] px-8 py-4 flex items-center justify-between shadow-sm">
    <div class="flex items-center">
      <a href="{{ url('/welcome') }}" class="text-2xl font-bold text-[#01C38D]">JOBJIK</a>
    </div>
    <div>
      <a href="{{ route('signin') }}"
         class="px-4 py-1 rounded-md bg-[#01C38D] text-gray-900 font-semibold hover:bg-[#019d6f] transition-colors">
        Sign in
      </a>
    </div>
  </nav>

  <!-- Landing Hero Section -->
  <div class="flex flex-col items-center justify-center flex-1 py-20">
    <img src="{{ asset('logo.png') }}" class="h-32 mb-8" alt="JobJik Logo">
    <h1 class="text-4xl font-bold mb-4 text-[#01C38D]">Welcome to JobJik</h1>
    <p class="text-xl text-gray-200 mb-6">Cambodia’s easiest way to find jobs and hire talent.</p>
    <a href="{{ url('/jobs') }}"
       class="bg-[#01C38D] text-gray-900 font-bold px-8 py-3 rounded-lg text-lg shadow-lg transition
              hover:bg-[#019d6f] hover:shadow-[0_8px_32px_0_rgba(1,195,141,0.2)] focus:outline-none focus:ring-4 focus:ring-[#01C38D]/50">
      Browse Jobs
    </a>
  </div>
</body>
</html>
