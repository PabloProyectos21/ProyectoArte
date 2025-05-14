<x-app-layout>
        <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">User Management</h1>

        <!-- Buscador -->
        <form method="GET" action="{{ route('admin.users') }}" class="mb-6">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Search by username or email"
                   class="w-full sm:w-1/2 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300">
        </form>

        <!-- Tabla de usuarios -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full table-auto text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Surname</th>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Plan</th>
                    <th class="px-6 py-3">Created</th>
                    <th class="px-6 py-3 text-right">Delete</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->surname }}</td>
                        <td class="px-6 py-4">{{ $user->username }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $user->is_premium === 1 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-700' }}">
                                {{ $user->is_premium === 1 ? 'Premium': 'Basic' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Edit
                            </a>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Delete
                                </button>
                            </form>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $users->withQueryString()->links() }}

        </div>
            <a href="{{ route('admin.dashboard') }}"
               class="text-gray-700 hover:underline">← Back</a>
    </div>

</x-app-layout>
