<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create Commercial</h1>

        <form method="POST" action="{{ route('admin.commercials.store') }}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            @csrf

            <div>
                <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-white">Company</label>
                <select name="company_id" id="company_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="media_url" class="block text-sm font-medium text-gray-700 dark:text-white">Website URL</label>
                <input type="url" name="media_url" id="media_url" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div>
                <label for="publication_date" class="block text-sm font-medium text-gray-700 dark:text-white">Publication Date</label>
                <input type="date" name="publication_date" id="publication_date" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div>
                <label for="expiration_date" class="block text-sm font-medium text-gray-700 dark:text-white">Expiration Date</label>
                <input type="date" name="expiration_date" id="expiration_date" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-white">Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-purple-600 file:text-white hover:file:bg-purple-700">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-2 rounded-lg shadow hover:from-purple-600 hover:to-pink-600 transition">
                    Publish Ad
                </button>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-gray-700 hover:underline">← Back</a>
            </div>
        </form>
    </div>
</x-app-layout>
