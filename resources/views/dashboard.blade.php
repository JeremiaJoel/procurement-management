{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Hak Akses</title>
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
        <div class="flex-1 overflow-y-auto p-6 relative z-10">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%);">
            </div>
            <header class="flex justify-between items-center mb-6 relative z-10">
                <h1 class="text-2xl font-bold text-white">
                    Dashboard
                </h1>
                {{-- <div class="flex items-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:bg-red-500 rounded-lg p-1">
                            Logout
                        </button>
                    </form>
                </div> --}}

            </header>
            <div class="bg-white p-6 rounded-lg shadow-lg relative z-10">
                <nav class="mb-6">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-red-600 border-b-2 border-red-600 pb-2" href="#">
                                My Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-600 pb-2" href="#">
                                Dashboard Staff
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-600 pb-2" href="#">
                                Dashboard E-Procurement
                            </a>
                        </li>
                    </ul>
                </nav>
                <section class="mb-6">
                    <h2 class="text-xl font-bold mb-4">
                        Overview
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        17
                                    </h3>
                                    <p class="text-gray-600">
                                        Total PR
                                    </p>
                                </div>
                                <i class="fas fa-file-alt text-blue-500 text-3xl">
                                </i>
                            </div>
                            <a class="text-red-600 flex items-center" href="#">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2">
                                </i>
                            </a>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        0
                                    </h3>
                                    <p class="text-gray-600">
                                        Total PO
                                    </p>
                                </div>
                                <i class="fas fa-shopping-cart text-orange-500 text-3xl">
                                </i>
                            </div>
                            <a class="text-red-600 flex items-center" href="#">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2">
                                </i>
                            </a>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        2
                                    </h3>
                                    <p class="text-gray-600">
                                        Total PO Outstanding
                                    </p>
                                </div>
                                <i class="fas fa-clipboard-list text-purple-500 text-3xl">
                                </i>
                            </div>
                            <a class="text-red-600 flex items-center" href="#">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2">
                                </i>
                            </a>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        1
                                    </h3>
                                    <p class="text-gray-600">
                                        Material Outstanding
                                    </p>
                                </div>
                                <i class="fas fa-star text-green-500 text-3xl">
                                </i>
                            </div>
                            <a class="text-red-600 flex items-center" href="#">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2">
                                </i>
                            </a>
                        </div>
                    </div>
                </section>
                <section class="mb-6">
                </section>
            </div>
        </div>
    </div>
</body>

</html>
