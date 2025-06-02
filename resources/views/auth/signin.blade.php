<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In - JOBPADOY</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#121620] text-white min-h-screen flex items-center justify-center">

  <div class="w-full max-w-xl bg-[#181c27] border border-[#23283a] rounded-xl shadow-lg px-8 py-10">
    <!-- Logo at the top center, clickable -->
    <div class="flex justify-center mb-6">
      <a href="{{ url('/welcome') }}">
        <img src="{{ asset('logo.png') }}" alt="JOBPADOY Logo" class="h-20" />
      </a>
    </div>
    <h2 class="text-3xl font-bold text-[#01C38D] mb-8 text-center">Sign in to your account</h2>

    @if(session('error'))
      <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4 text-center font-medium">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('signin.post') }}" method="POST">
      @csrf

      <div class="mb-8">
        <label for="email" class="block text-white font-semibold mb-1">E-mail *</label>
        <input name="email" id="email" type="email" required
               class="w-full px-4 py-2 rounded bg-[#23283a] border border-[#23283a] focus:border-[#01C38D] text-white" value="{{ old('email') }}">
        @error('email')
          <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-8">
        <label for="password" class="block text-white font-semibold mb-1">Password *</label>
        <input name="password" id="password" type="password" required
               class="w-full px-4 py-2 rounded bg-[#23283a] border border-[#23283a] focus:border-[#01C38D] text-white">
        @error('password')
          <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-8 flex justify-between text-sm font-medium">
        <div>
          <div class="flex items-center space-x-2">
            <input type="checkbox" name="remember" id="remember"
              class="rounded-sm border border-slate-400 accent-[#01C38D]">
            <label for="remember" class="text-white">Remember me</label>
          </div>
        </div>
        <div>
          <a href="{{ route('register') }}" class="text-[#01C38D] hover:underline">Sign Up</a>
        </div>
      </div>

      <button type="submit"
        class="w-full bg-[#01C38D] text-gray-900 font-bold px-6 py-2 rounded-lg hover:bg-[#019d6f] transition-colors shadow">
        Login
      </button>
    </form>
  </div>

</body>
</html>
