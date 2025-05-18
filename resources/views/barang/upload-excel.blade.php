<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Upload Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/barang.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>

</head>

<!-- resources/views/permissions/index.blade.php -->


<body class="bg-blue-900 font-sans font-semibold">
    @include('layouts.loader')

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar-new')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%);"></div>
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
                <h1 class="text-white text-lg font-semibold truncate">Barang / Upload Excel</h1>
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

            <div class="bg-white p-6 rounded-lg shadow-lg relative z-10 max-w-3xl mx-auto">
                <nav class="mb-6">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-gray-500 pb-2 cursor-pointer hover:text-blue-600 transition"
                                href="{{ route('barang.index') }}">
                                List Kategori Barang
                            </a>
                        </li>
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 cursor-pointer pb-2">
                                Upload Excel
                            </p>
                        </li>
                        <li>
                            <a class="text-gray-500 pb-2 cursor-default" href="#">
                                Edit Barang
                            </a>
                        </li>
                    </ul>
                </nav>

                <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="excelFile" class="block text-gray-700 font-semibold mb-2">Pilih file Excel (.xlsx,
                            .xls)</label>
                        <input type="file" name="excelFile" id="excelFile" accept=".xlsx,.xls"
                            class="block w-full text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            required />
                    </div>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 transition">
                            <i class="fas fa-file-upload mr-2"></i> Upload Excel
                        </button>
                        <a href="{{ route('barang.index') }}"
                            class="inline-block px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
