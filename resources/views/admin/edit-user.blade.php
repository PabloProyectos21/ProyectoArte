<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit User</h1>

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Surname</label>
                <input type="text" name="surname" value="{{ old('surname', $user->surname) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Plan</label>
                <select name="is_premium"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="0" {{ $user->is_premium == 0 ? 'selected' : '' }}>Basic</option>
                    <option value="1" {{ $user->is_premium == 1 ? 'selected' : '' }}>Premium</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">New Password <span class="text-gray-500">(optional)</span></label>
                <input type="password" name="password"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.users') }}"
                   class="text-gray-700 hover:underline">← Back</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    Update User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
