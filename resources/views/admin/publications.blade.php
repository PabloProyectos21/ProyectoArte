<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Publication Management</h1>

        <!-- Buscador -->
        <form method="GET" action="{{ route('admin.publications') }}" class="mb-6">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Search by title"
                   class="w-full sm:w-1/2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-purple-300">
        </form>

        <!-- Tabla -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full table-auto text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Image</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Author</th>
                    <th class="px-6 py-3">Created</th>
                    <th class="px-6 py-3 text-center">Delete</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($publications as $publication)
                    <tr>
                        <td class="px-6 py-4">
                            @php
                                $imgSrc = $publication->image_route
                                    ? (Str::startsWith($publication->image_route, ['http://','https://'])
                                        ? $publication->image_route
                                        : asset('storage/' . $publication->image_route))
                                    : asset('images/no-image.png');
                            @endphp
                            <img src="{{ $imgSrc }}"
                                 alt="image"
                                 class="w-16 h-16 object-cover rounded-lg border shadow"
                                 style="background: #f3f3f3;">
                        </td>
                        <td class="px-6 py-4">{{ $publication->title }}</td>
                        <td class="px-6 py-4">{{ $publication->user->username ?? '—' }}</td>
                        <td class="px-6 py-4">{{ $publication->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-center mt-2">
                                <form action="{{ route('admin.publications.delete', $publication->id) }}" method="POST">
                                <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Delete
                                </button>
                                    </form>
                            </div>
                            <!-- ...tu modal aquí... -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No publications found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:underline">
                ← Back
            </a>
            <div>
                {{ $publications->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
