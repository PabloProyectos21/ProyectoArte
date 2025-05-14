<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Companies</h1>

        <form method="GET" action="{{ route('admin.companies') }}" class="mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search companies..." class="w-full sm:w-1/2 px-4 py-2 border rounded-md shadow-sm">
        </form>

        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full table-auto text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Company</th>
                    <th class="px-6 py-3">NIF</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($companies as $company)
                    <tr>
                        <td class="px-6 py-4">{{ $company->company_name }}</td>
                        <td class="px-6 py-4">{{ $company->nif }}</td>
                        <td class="px-6 py-4">{{ $company->contact_email }}</td>
                        <td class="px-6 py-4">{{ $company->phone_number }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <!-- Botón Editar -->
                                <a href="{{ route('admin.companies.edit', $company->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 text-sm rounded-lg">
                                    Edit
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('admin.companies.delete', $company->id) }}" method="POST" onsubmit="return confirm('Delete this company?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 text-sm rounded-lg">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No companies found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
        <a href="{{ route('admin.dashboard') }}"
           class="text-gray-700 hover:underline">← Back</a>
        <div class="mt-6">
            {{ $companies->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
