<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Edit Publication</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('publications.update', $publication->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-xl shadow-md">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $publication->title) }}" required
                       class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-purple-300">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-purple-300">{{ old('description', $publication->description) }}</textarea>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category"
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-purple-300">
                    @foreach(['photography', 'tattoos', 'painting', 'draws', 'fashion', 'other'] as $category)
                        <option value="{{ $category }}" {{ $publication->category === $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Current image preview -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Current Image</label>
                @php
                    $isUrl = Str::startsWith($publication->image_route, ['http://', 'https://']);
                    $imageSrc = $isUrl ? $publication->image_route : asset('storage/' . $publication->image_route);
                @endphp

                <img src="{{ $imageSrc }}" alt="{{ $publication->title }}"  class="w-full rounded-lg shadow hover:scale-[1.02] transition duration-300 ease-in-out">

            </div>

            <!-- New image -->
            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Replace Image (optional)</label>
                <input type="file" name="image" id="image"
                       class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-lg shadow focus:ring-4 focus:outline-none focus:ring-purple-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
