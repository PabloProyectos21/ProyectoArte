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
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Author</th>
                    <th class="px-6 py-3">Created</th>
                    <th class="px-6 py-3 text-center">Delete</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($publications as $publication)
                    <tr>
                        <td class="px-6 py-4">{{ $publication->title }}</td>
                        <td class="px-6 py-4">{{ $publication->user->username ?? '—' }}</td>
                        <td class="px-6 py-4">{{ $publication->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div  class="flex justify-center mt-2">

                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"  type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Delete
                                </button>
                            </div>
                            <div id="popup-modal" role="dialog" aria-modal="true" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center ">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this post?</h3>

                                            <form action="{{ route('admin.publications.delete', $publication->id) }}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-400 hover:bg-pink-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Delete
                                                </button>
                                                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>

                                            </form>
                                             </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No publications found.</td>
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

