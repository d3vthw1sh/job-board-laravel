<x-layout>
  <x-breadcrumbs class="mb-6 text-sm text-gray-500" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />

  {{-- Main job detail card --}}
  <x-job-card :$job class="mb-8 p-6 border border-gray-100 bg-white shadow-sm rounded-lg">
    <p class="mb-6 text-sm text-gray-600 leading-relaxed whitespace-pre-line">
      {!! nl2br(e($job->description)) !!}
    </p>

    @can('apply', $job)
      <x-link-button
        :href="route('job.application.create', $job)"
        class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm"
      >
        Apply
      </x-link-button>
    @else
      <div class="text-center text-sm font-medium text-gray-400">
        You already applied to this job
      </div>
    @endcan
  </x-job-card>

  {{-- "More jobs at..." card matching style and theme --}}
  <x-card class="p-6 mb-10 bg-gray-900 border border-gray-800 shadow-sm rounded-lg text-white">
    <h2 class="mb-4 text-lg font-semibold">
      More jobs at {{ $job->employer->company_name }}
    </h2>

    <div class="divide-y divide-gray-800 text-sm">
      @foreach ($job->employer->jobs as $otherJob)
        <div class="flex justify-between py-3">
          <div>
            <a
              href="{{ route('jobs.show', $otherJob) }}"
              class="text-[#01C38D] hover:underline font-medium"
            >
              {{ $otherJob->title }}
            </a>
            <div class="text-xs text-gray-400">
              {{ $otherJob->created_at->diffForHumans() }}
            </div>
          </div>
          <div class="text-xs font-semibold text-gray-300">
            ${{ number_format($otherJob->salary) }}
          </div>
        </div>
      @endforeach
    </div>
  </x-card>
</x-layout>
