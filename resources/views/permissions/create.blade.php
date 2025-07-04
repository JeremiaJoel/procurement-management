<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-blue-900 font-sans font-semibold">
    @include('layouts.loader')

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar-new')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%);">
            </div>
            <header class="flex justify-between items-center mb-6 relative z-10">
                <button id="sidebarToggle" aria-label="Toggle sidebar"
                    class="text-white focus:outline-none mr-6 lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="text-white text-lg font-semibold truncate">Manajemen Utilitas / Buat utilitas</h1>
                <div class="ml-auto flex items-center space-x-4">
                    <div class="flex flex-col text-right">
                        <span class="text-white font-semibold text-sm leading-tight truncate max-w-[120px]">
                            {{ Auth::user()->name }}
                        </span>
                        <span class="text-red-400 text-xs uppercase tracking-wide font-medium">
                            {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                        </span>
                    </div>
                </div>
            </header>
            <div class="bg-white p-6 rounded-lg shadow-lg relative z-10">
                <nav class="mb-6">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-red-600 border-b-2 border-red-600 pb-2" href="#">
                                Membuat Utilitas
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-700 pb-2" href="{{ route('permissions.index') }}">
                                List Menu
                            </a>
                        </li>
                        <li>
                            <p class="text-gray-700 pb-2 cursor-default" href="#">
                                Edit Utilitas
                            </p>
                        </li>

                    </ul>
                </nav>
                <section id="list-staff" class="mb-6 flex justify-center">
                    <form action="{{ route('permissions.store') }}" method="POST" class="space-y-4 w-full max-w-md">
                        @csrf
                        <div>
                            <label for="permissions" class="block text-sm font-medium text-gray-700">Hak Akses</label>
                            <input type="text" id="buat-hak-akses" name="name" value="{{ old('name') }}"
                                placeholder="Hak akses"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            @error('name')
                                <p class="text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-red-500 text-white p-2 rounded-md hover:bg-red-600">Submit</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
