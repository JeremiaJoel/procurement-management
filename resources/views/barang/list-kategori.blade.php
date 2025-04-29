<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/kategori.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<!-- resources/views/permissions/index.blade.php -->

<script>
    window.addEventListener("load", function() {
        const loader = document.getElementById("loader");

        // Biar kelihatan dulu sebentar (contoh 100ms)
        setTimeout(() => {
            loader.classList.add("fade-out");

            // Setelah animasi selesai (0.5 detik), sembunyikan
            setTimeout(() => {
                loader.style.display = "none";
            }, 500);
        }, 100); // Tambahkan delay 100ms sebelum mulai fade-out
    });
</script>

<style>
    #loader {
        transition: opacity 0.5s ease;
    }

    #loader.fade-out {
        opacity: 0;
        pointer-events: none;
    }
</style>

<body class="bg-gray-100 font-sans font-semibold">
    <div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="relative">
            <div class="h-24 w-24 rounded-full border-t-8 border-b-8 border-gray-200"></div>
            <div
                class="absolute top-0 left-0 h-24 w-24 rounded-full border-t-8 border-b-8 border-blue-500 animate-spin">
            </div>
        </div>
    </div>
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
                <h1 class="text-white text-lg font-semibold truncate">Menu Kategori</h1>
                <div class="ml-auto flex items-center space-x-4">
                    <button aria-label="Notifications" class="text-white hover:text-red-200 focus:outline-none">
                        <i class="fas fa-bell fa-lg"></i>
                    </button>
                    <button aria-label="User menu" class="text-white hover:text-red-200 focus:outline-none">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </button>
                </div>
            </header>

            <div class="bg-white p-6 rounded-lg shadow-lg relative z-10">
                <nav class="mb-3">
                    <ul class="flex space-x-6">
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 pb-2" href="">
                                List Kategori Barang
                            </p>
                        </li>
                        <li>
                            <a class="text-gray-500 cursor-pointer pb-2" href="{{ route('barang.create') }}">
                                Menambah Barang
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 pb-2 cursor-default" href="#">
                                Edit Barang
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-500 pb-2 cursor-pointer" href="{{ route('kategori.index') }}">
                                Tambah Kategori
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container mx-auto p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Card 1 -->
                        @foreach ($categories as $category)
                            <div
                                class="bg-white rounded-lg shadow-xl p-4 hover:scale-105 hover:transition-all cursor-pointer">
                                <div class="text-xl font-bold mb-4 inset-0 text-center">
                                    {{ $category->nama }}
                                </div>
                                <div class="flex justify-center items-center inset-0">
                                    <a href="{{ route('barang.by-category', $category->id_kategori) }}">

                                        <img alt="{{ $category->nama }}"
                                            class="h-full w-full rounded-lg opacity-85 bg-cover"
                                            src="{{ asset('storage/' . $category->image) }}" />
                                    </a>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-success px-3 items-center m-2"
                                        onclick="window.location.href='{{ route('kategori.edit', $category->id_kategori) }}'">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger px-2 items-center m-2 delete-btn"
                                        data-id="{{ $category->id_kategori }}">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <!-- Card 2 -->
                        <!-- Card 3 -->
                        <!-- Card 4 -->
                        <!-- Card n -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const deleteKategoriUrl = "{{ route('kategori.destroy') }}"
</script>
