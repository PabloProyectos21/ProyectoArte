<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Edit Company</h1>

        <form method="POST" action="{{ route('admin.companies.update', $company->id) }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="company_name" class="block mb-1 text-sm font-medium text-gray-700">Company Name</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name) }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-purple-200" required>
            </div>

            <div class="mb-4">
                <label for="nif" class="block mb-1 text-sm font-medium text-gray-700">NIF</label>
                <input type="text" id="nif" name="nif" value="{{ old('nif', $company->nif) }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-purple-200" required>
            </div>

            <div class="mb-4">
                <label for="contact_email" class="block mb-1 text-sm font-medium text-gray-700">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $company->contact_email) }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-purple-200" required>
            </div>

            <div class="mb-6">
                <label for="phone_number" class="block mb-1 text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $company->phone_number) }}"
                       class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-purple-200" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.companies') }}" class="text-sm text-gray-600 hover:underline">← Back</a>
                <button type="submit"
                        class="bg-emerald-500 text-white px-6 py-2 rounded-lg shadow hover:from-green-600 hover:to-emerald-600 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
