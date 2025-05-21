<x-app-layout>
    @include('components.sidebar')
    <div class="p-4 sm:ml-64">
        @if(Auth::user()->is_premium && Auth::user()->background_image)
            <div
                class="fixed inset-0 z-0 "
                style="background: url('{{ secure_asset(Auth::user()->background_image) }}') center center / cover no-repeat; opacity: 0.35;">
            </div>
        @endif
        <div class="relative p-4  rounded-lg mt-14 z-10">
    <div class="max-w-2xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Create Publication</h1>

        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select a category</option>
                    @foreach(['photography', 'tattoos', 'painting', 'draws', 'fashion', 'other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" accept="image/*"
                       class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold px-4 py-2 rounded-lg hover:shadow-lg transition">
                    Create
                </button>
            </div>
        </form>
    </div>
        </div>
    </div>
</x-app-layout>

