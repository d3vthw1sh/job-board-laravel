<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - JobJik</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#121620] text-white min-h-screen flex items-center justify-center">

  <div class="w-full max-w-xl bg-[#181c27] border border-[#23283a] rounded-xl shadow-lg px-8 py-10">
      <h2 class="text-3xl font-bold text-[#01C38D] mb-6 text-center">Sign Up</h2>
      <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-4">
              <label for="name" class="block mb-1 font-semibold">Name</label>
              <input type="text" id="name" name="name" required
                  class="w-full px-4 py-2 rounded bg-[#23283a] border border-[#23283a] focus:border-[#01C38D] text-white" value="{{ old('name') }}">
              @error('name')
                  <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
              @enderror
          </div>
          <div class="mb-4">
              <label for="email" class="block mb-1 font-semibold">Email</label>
              <input type="email" id="email" name="email" required
                  class="w-full px-4 py-2 rounded bg-[#23283a] border border-[#23283a] focus:border-[#01C38D] text-white" value="{{ old('email') }}">
              @error('email')
                  <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
              @enderror
          </div>
          <div class="mb-4">
              <label for="password" class="block mb-1 font-semibold">Password</label>
              <input type="password" id="password" name="password" required
                  class="w-full px-4 py-2 rounded bg-[#23283a] border border-[#23283a] focus:border-[#01C38D] text-white">
              @error('password')
                  <div class="text-red-400 text-xs mt-1">{{ $message }}</div>
              @enderror
          </div>
          <div class="mb-6">
              <label for="password_confirmation" class="block mb-1 font-semibold">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" required
                  class="w-full px-4 py-2 rounded bg-[#23283a] border border-[#23283a] focus:border-[#01C38D] text-white">
          </div>
          <button type="submit"
              class="w-full bg-[#01C38D] text-gray-900 font-bold px-6 py-2 rounded-lg hover:bg-[#019d6f] transition-colors shadow">
              Sign Up
          </button>
      </form>
      <div class="mt-6 text-center text-sm text-gray-300">
          Already have an account?
          <a href="{{ route('signin') }}" class="text-[#01C38D] hover:underline">Sign In</a>
      </div>
  </div>

</body>
</html>
