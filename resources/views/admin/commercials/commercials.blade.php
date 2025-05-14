<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Commercials</h1>

        <form method="GET" action="{{ route('admin.commercials') }}" class="mb-6">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by company or URL..."
                   class="w-full sm:w-1/2 px-4 py-2 border rounded-md shadow-sm">
        </form>

        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full table-auto text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Company</th>
                    <th class="px-6 py-3">URL</th>
                    <th class="px-6 py-3">Starts</th>
                    <th class="px-6 py-3">Expires</th>
                    <th class="px-6 py-3">Clicks</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($commercials as $commercial)
                    <tr>
                        <td class="px-6 py-4">{{ $commercial->company->company_name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ $commercial->media_url }}" class="text-blue-600 hover:underline" target="_blank">
                                {{ Str::limit($commercial->media_url, 30) }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $commercial->publication_date }}</td>
                        <td class="px-6 py-4">{{ $commercial->expiration_date }}</td>
                        <td class="px-6 py-4">{{ $commercial->clicks }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.commercials.edit', $commercial->id) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 text-sm rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('admin.commercials.delete', $commercial->id) }}"
                                  method="POST" class="inline" onsubmit="return confirm('Delete this commercial?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 text-sm rounded-lg">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No commercials found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:underline mt-6 inline-block">← Back</a>

        <div class="mt-6">
            {{ $commercials->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
