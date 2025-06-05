<x-layout>
  <h1 class="text-2xl font-bold mb-6">Admin Job Panel</h1>

  @if(session('success'))
    <div class="bg-green-600 text-white p-3 rounded mb-4">{{ session('success') }}</div>
  @endif

  <table class="min-w-full bg-[#191E29] rounded-md overflow-hidden text-white">
    <thead class="bg-[#23283a]">
      <tr>
        <th class="px-6 py-3 text-left">Title</th>
        <th class="px-6 py-3 text-left">Company</th>
        <th class="px-6 py-3 text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($jobs as $job)
      <tr class="border-b border-[#2c3440]">
        <td class="px-6 py-4">{{ $job->title }}</td>
        <td class="px-6 py-4">{{ $job->company }}</td>
        <td class="px-6 py-4">
          <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">
    {{ $jobs->links() }}
  </div>
</x-layout>
