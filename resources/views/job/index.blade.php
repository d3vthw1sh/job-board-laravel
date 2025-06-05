<x-layout class="min-h-screen bg-[#132D46] text-white">
  <x-breadcrumbs class="mb-8 text-sm text-[#01C38D]" :links="['Jobs' => route('jobs.index')]" />

  {{-- Filter Card --}}
  <x-card class="mb-12 p-8 bg-[#181c27]/90 border border-[#23283a] rounded-2xl shadow-lg text-base max-w-3xl mx-auto" x-data="">
    <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

        {{-- Search --}}
        <div>
          <label class="flex items-center gap-2 font-semibold mb-2 text-white text-base">
            <svg class="w-5 h-5 text-[#01C38D]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <circle cx="11" cy="11" r="8" stroke-width="2"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Search
          </label>
          <x-text-input name="search" value="{{ request('search') }}"
            placeholder="Search..." form-ref="filters"
            class="w-full rounded-lg bg-[#23283a] border border-[#313848] text-white placeholder-gray-400 focus:ring-2 focus:ring-[#01C38D] transition" />
        </div>

        {{-- Salary --}}
        <div>
          <label class="flex items-center gap-2 font-semibold mb-2 text-white text-base">
            <svg class="w-5 h-5 text-[#FFD600]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <rect x="2" y="6" width="20" height="12" rx="2" stroke-width="2"/>
              <path d="M6 10h12M6 14h12" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Salary Range
          </label>
          <div class="flex gap-3">
            <x-text-input name="min_salary" value="{{ request('min_salary') }}"
              placeholder="From" form-ref="filters"
              class="w-1/2 rounded-lg bg-[#23283a] border border-[#313848] text-white placeholder-gray-400 focus:ring-2 focus:ring-[#01C38D] transition" />
            <x-text-input name="max_salary" value="{{ request('max_salary') }}"
              placeholder="To" form-ref="filters"
              class="w-1/2 rounded-lg bg-[#23283a] border border-[#313848] text-white placeholder-gray-400 focus:ring-2 focus:ring-[#01C38D] transition" />
          </div>
        </div>

        {{-- Experience --}}
        <div>
          <label class="flex items-center gap-2 font-semibold mb-2 text-white text-base">
            <svg class="w-5 h-5 text-[#01C38D]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <rect x="4" y="4" width="16" height="16" rx="4" stroke-width="2"/>
              <path d="M9 12l2 2l4-4" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Experience
          </label>
          <div class="space-y-1 pl-1 text-sm">
            <x-radio-group name="experience"
              :options="array_combine(
                  array_map('ucfirst', \App\Models\Job::$experience),
                  \App\Models\Job::$experience,
              )"
              class="mb-1 accent-[#01C38D]" />
          </div>
        </div>

        {{-- Category --}}
        <div>
          <label class="flex items-center gap-2 font-semibold mb-2 text-white text-base">
            <svg class="w-5 h-5 text-[#FFD600]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <rect x="4" y="7" width="16" height="13" rx="2" stroke-width="2"/>
              <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke-width="2"/>
            </svg>
            Category
          </label>
          <div class="space-y-1 pl-1 text-sm">
            <x-radio-group name="category" :options="\App\Models\Job::$category" class="mb-1 accent-[#FFD600]" />
          </div>
        </div>
      </div>

      {{-- Submit --}}
      <button type="submit"
        class="w-full py-3 text-base font-bold rounded-xl transition bg-[#01C38D] text-[#181c27] hover:bg-[#019d6f] shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#01C38D] flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Apply Filters
      </button>
    </form>
  </x-card>

  {{-- Job List --}}
  <div class="space-y-5">
    @foreach ($jobs as $job)
      <x-job-card :$job class="p-5 bg-[#191E29] border border-[#2c3440] rounded-md hover:border-[#01C38D] transition text-white">
        <div class="flex justify-end mt-4">
          <a href="{{ route('jobs.show', $job) }}"
            class="inline-block px-4 py-2 text-sm font-medium text-[#132D46] bg-[#01C38D] rounded-md hover:opacity-90 transition">
            View
          </a>
        </div>
      </x-job-card>
    @endforeach
  </div>

  {{-- Pagination --}}
  <div class="mt-8 flex justify-center">
    {{ $jobs->links('vendor.pagination.custom') }}
  </div>
</x-layout>
