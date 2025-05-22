<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Commercial</h1>

        <form method="POST" action="{{ route('admin.commercials.update', $commercial->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Company</label>
                <select name="company_id" class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $commercial->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Media URL</label>
                <input type="text" name="media_url" value="{{ old('media_url', $commercial->media_url) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Image (optional)</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-600">
                @if ($commercial->image)
                    <p class="text-sm text-gray-500 mt-1">Current: <a href="{{ secure_asset( $commercial->image ) }}" target="_blank" class="text-blue-600 hover:underline">View</a></p>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Publication Date</label>
                    <input type="date" name="publication_date" value="{{ old('publication_date', $commercial->publication_date) }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Expiration Date</label>
                    <input type="date" name="expiration_date" value="{{ old('expiration_date', $commercial->expiration_date) }}"
                           class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('admin.commercials') }}" class="text-gray-600 hover:underline">← Back</a>
                <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg shadow">
                    Update Commercial
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
