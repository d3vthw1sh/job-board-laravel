<x-layout>
  <x-breadcrumbs :links="['My Jobs' => '#']" class="mb-4" />

  <div class="mb-8 text-right">
    <x-link-button href="{{ route('my-jobs.create') }}">Add New</x-link-button>
  </div>

  @forelse ($jobs as $job)
    <x-job-card :$job>
      <div class="text-xs text-slate-500">
        @forelse ($job->jobApplications as $application)
          <div class="mb-4 flex items-center justify-between">
            <div>
              <div>{{ $application->user->name }}</div>
              <div>
                Applied {{ $application->created_at->diffForHumans() }}
              </div>
              @if ($application->cv_path)
                <div>
                  <a href="{{ route('job_applications.download_cv', $application->id) }}"
                     class="text-blue-600 underline"
                     target="_blank" rel="noopener">
                    Download CV
                  </a>
                </div>
              @else
                <div>No CV uploaded</div>
              @endif

              {{-- SHOW APPROVED STATUS OR APPROVE BUTTON --}}
              @if ($application->approved_for_interview)
                <div class="mt-2 px-2 py-1 rounded bg-green-100 text-green-700 text-xs inline-block">
                  Approved for Interview
                </div>
              @else
                <form action="{{ route('job_applications.approve', $application->id) }}" method="POST" class="mt-2 inline-block">
                  @csrf
                  <button type="submit"
                    class="px-2 py-1 bg-indigo-500 hover:bg-indigo-600 text-white text-xs rounded">
                    Approve for Interview
                  </button>
                </form>
              @endif
            </div>
            <div>${{ number_format($application->expected_salary) }}</div>
          </div>
        @empty
          <div>No applications yet</div>
        @endforelse

        <div class="flex space-x-2">
          <x-link-button href="{{ route('my-jobs.edit', $job) }}">Edit</x-link-button>
          <form action="{{ route('my-jobs.destroy', $job) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-button>Delete</x-button>
          </form>
        </div>
      </div>
    </x-job-card>
  @empty
    <div class="rounded-md border border-dashed border-slate-300 p-8">
      <div class="text-center font-medium">
        No jobs yet
      </div>
      <div class="text-center">
        Post your first job <a class="text-indigo-500 hover:underline"
          href="{{ route('my-jobs.create') }}">here!</a>
      </div>
    </div>
  @endforelse
</x-layout>
