<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create New Company</h1>

        <form method="POST" action="{{ route('admin.companies.store') }}" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
            @csrf

            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-white">Company Name</label>
                <input type="text" name="company_name" id="company_name" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div>
                <label for="nif" class="block text-sm font-medium text-gray-700 dark:text-white">NIF</label>
                <input type="text" name="nif" id="nif" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div>
                <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-white">Contact Email</label>
                <input type="email" name="contact_email" id="contact_email" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-white">Phone Number (optional)</label>
                <input type="text" name="phone_number" id="phone_number" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-purple-500">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-emerald-500 text-black px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-emerald-600 transition">
                    Save Company
                </button>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="text-gray-700 hover:underline">← Back</a>
        </form>
    </div>
</x-app-layout>
