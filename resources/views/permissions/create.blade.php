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

<body class="bg-gray-100 font-sans font-semibold">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%);">
            </div>
            <header class="flex justify-between items-center mb-6 relative z-10">
                <h1 class="text-2xl font-bold text-white">
                    Manajemen Menu
                </h1>
                <div class="flex items-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:bg-red-500 rounded-lg p-1">
                            Logout
                        </button>
                    </form>
                </div>
            </header>
            <div class="bg-white p-6 rounded-lg shadow-lg relative z-10">
                <nav class="mb-6">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-red-600 border-b-2 border-red-600 pb-2" href="#">
                                Membuat Hak Akses Menu
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-700 pb-2" href="{{ route('permissions.index') }}">
                                List Menu
                            </a>
                        </li>
                        <li>
                            <p class="text-gray-700 pb-2 cursor-default" href="#">
                                Edit Hak Akses Menu
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
