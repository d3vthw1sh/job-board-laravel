<x-layout class="min-h-screen bg-[#132D46] text-white">
  <x-breadcrumbs class="mb-8 text-sm text-[#01C38D]" :links="['Jobs' => route('jobs.index')]" />

  {{-- Filter Card --}}
  <x-card class="mb-12 p-6 bg-[#191E29] border border-[#1f2937] rounded-lg shadow-md text-sm" x-data="">
    <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        {{-- Search --}}
        <div>
          <label class="block text-white font-medium mb-1">🔍 Search</label>
          <x-text-input name="search" value="{{ request('search') }}"
            placeholder="Search..." form-ref="filters"
            class="w-full bg-[#132D46] border border-[#1f2937] text-white placeholder-gray-400" />
        </div>

        {{-- Salary --}}
        <div>
          <label class="block text-white font-medium mb-1">💰 Salary Range</label>
          <div class="flex gap-3">
            <x-text-input name="min_salary" value="{{ request('min_salary') }}"
              placeholder="From" form-ref="filters"
              class="w-1/2 bg-[#132D46] border border-[#1f2937] text-white placeholder-gray-400" />
            <x-text-input name="max_salary" value="{{ request('max_salary') }}"
              placeholder="To" form-ref="filters"
              class="w-1/2 bg-[#132D46] border border-[#1f2937] text-white placeholder-gray-400" />
          </div>
        </div>

        {{-- Experience --}}
        <div>
          <label class="block text-white font-medium mb-1">📈 Experience</label>
          <div class="text-white space-y-1">
            <x-radio-group name="experience"
              :options="array_combine(
                  array_map('ucfirst', \App\Models\Job::$experience),
                  \App\Models\Job::$experience,
              )" />
          </div>
        </div>

        {{-- Category --}}
        <div>
          <label class="block text-white font-medium mb-1">🗂️ Category</label>
          <div class="text-white space-y-1">
            <x-radio-group name="category" :options="\App\Models\Job::$category" />
          </div>
        </div>
      </div>

      {{-- Submit --}}
      <button type="submit"
        class="w-full py-2 text-sm font-semibold rounded-md transition bg-[#01C38D] text-[#132D46] hover:opacity-90 shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#01C38D]">
        ✅ Apply Filters
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
</x-layout>
