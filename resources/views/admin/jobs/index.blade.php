<x-admin-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Admin: All Jobs</h1>

        <!-- Search form -->
        <form method="GET" action="{{ route('admin.jobs.index') }}" class="mb-6 flex items-center gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search job title..."
                class="px-3 py-2 rounded border border-gray-300 text-black w-64"
            />
            <button type="submit" class="bg-[#01C38D] text-white px-4 py-2 rounded font-semibold">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.jobs.index') }}" class="ml-2 text-gray-400 underline">Reset</a>
            @endif
        </form>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white text-black rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Title</th>
                    <th class="py-2 px-4">Company</th>
                    <th class="py-2 px-4">Posted At</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr>
                    <td class="py-2 px-4">{{ $job->id }}</td>
                    <td class="py-2 px-4">{{ $job->title }}</td>
                    <td class="py-2 px-4">{{ $job->employer->company_name ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $job->created_at->diffForHumans() }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Delete this job?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </div>
</x-admin-layout>
