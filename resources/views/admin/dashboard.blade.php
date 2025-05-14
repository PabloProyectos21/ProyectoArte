<x-app-layout>

    <div class="max-w-6xl mx-auto px-4 py-10">


        <h1 class="text-4xl font-extrabold text-gray-800 mb-10 text-center">Admin Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Gestión de Usuarios -->
            <a href="{{ route('admin.users') }}" class="block p-6 bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
                        <p class="text-sm text-gray-500">Total users: <span class="font-bold text-blue-700">{{ $userCount }}</span></p>
                    </div>
                </div>
            </a>

            <!-- Gestión de Publicaciones -->
            <a href="{{ route('admin.publications') }}" class="block p-6 bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v14a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Publication Management</h2>
                        <p class="text-sm text-gray-500">Total publications: <span class="font-bold text-purple-700">{{ $publicationCount }}</span></p>
                    </div>
                </div>
            </a>
            <!-- Gestión de Anuncios -->
            <a href="{{ route('admin.commercials.create') }}" class="block p-6 bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Create Advertisement</h2>
                        <p class="text-sm text-gray-500">Publish a new sponsored post</p>
                    </div>
                </div>
            </a>

            <!-- Gestión de Empresas -->
            <a href="{{ route('admin.companies.create') }}" class="block p-6 bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 10h18M3 6h18M3 14h10M3 18h6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Company Creator</h2>
                        <p class="text-sm text-gray-500">Add new advertising companies</p>
                    </div>
                </div>
            </a>
            <!-- Gestión de Empresas -->
            <a href="{{ route('admin.companies') }}" class="block p-6 bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 10h18M3 6h18M3 14h18M3 18h18" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Company Management</h2>
                        <p class="text-sm text-gray-500">Manage advertisers and partners</p>
                    </div>
                </div>
            </a>
            <!-- Gestión de Comerciales -->
            <a href="{{ route('admin.commercials') }}" class="block p-6 bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 9h8M8 13h6M8 17h4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Commercials</h2>
                        <p class="text-sm text-gray-500">Manage all ads in the system</p>
                    </div>
                </div>
            </a>

        </div>
        <div class="mt-12 flex flex-col items-center justify-center text-center">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-300 shadow">
                @php
                    $isUrl = Str::startsWith($user->profile_picture, ['http://', 'https://']);
                    $imageSrc = $isUrl ? $user->profile_picture : asset('storage/' . $user->profile_picture);
                @endphp
                <img  src="{{ $imageSrc }}"
                     alt="Profile Image"
                     class="w-full h-full object-cover">
            </div>
            <p class="mt-4 text-lg font-semibold text-gray-800">
                {{ $user->name }} {{ $user->surname }}
            </p>
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:underline">
                Back to the Page
            </a>
        </div>

    </div>
</x-app-layout>
