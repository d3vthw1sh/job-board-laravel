<x-card class="mb-4 bg-[#191E29] border border-[#2c3440] text-white">
  <div class="mb-4 flex justify-between items-start">
    <h2 class="text-lg font-semibold text-white">{{ $job->title }}</h2>
    <div class="text-[#01C38D] font-medium text-sm">
      ${{ number_format($job->salary) }}
    </div>
  </div>

  <div class="mb-4 flex items-center justify-between text-sm text-gray-300">
    <div class="flex items-center space-x-4">
      <div>{{ $job->employer->company_name }}</div>
      <div>{{ $job->location }}</div>
      @if ($job->deleted_at)
        <span class="text-xs text-red-400 font-semibold">Deleted</span>
      @endif
    </div>
    <div class="flex space-x-1 text-xs">
      <x-tag>
        <a href="{{ route('jobs.index', ['experience' => $job->experience]) }}"
           class="text-white hover:text-[#01C38D] transition">
          {{ Str::ucfirst($job->experience) }}
        </a>
      </x-tag>
      <x-tag>
        <a href="{{ route('jobs.index', ['category' => $job->category]) }}"
           class="text-white hover:text-[#01C38D] transition">
          {{ $job->category }}
        </a>
      </x-tag>
    </div>
  </div>

  {{ $slot }}
</x-card>
