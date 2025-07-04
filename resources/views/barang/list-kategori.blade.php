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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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

<body class="bg-blue-900 font-sans font-semibold">
    <div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="relative">
            <div class="h-24 w-24 rounded-full border-t-8 border-b-8 border-gray-200"></div>
            <div
                class="absolute top-0 left-0 h-24 w-24 rounded-full border-t-8 border-b-8 border-blue-900 animate-spin">
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
                <h1 class="text-white text-lg font-semibold truncate">Barang</h1>
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
                <nav class="mb-3">
                    <ul class="flex space-x-6">
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 pb-2" href="">
                                List Kategori Barang
                            </p>
                        </li>
                        {{-- <li>
                            <a class="text-gray-500 cursor-pointer pb-2" href="{{ route('barang.create') }}">
                                Menambah Barang
                            </a>
                        </li> --}}
                        {{-- <li>
                            <a class="text-gray-500 pb-2 cursor-default" href="#">
                                Edit Barang
                            </a>
                        </li> --}}
                        {{-- <li>
                                <a class="text-gray-500 pb-2 cursor-pointer" href="{{ route('kategori.index') }}">
                                    Tambah Kategori
                                </a>
                            </li> --}}
                    </ul>
                </nav>
                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mb-6">
                    @can('Tambah Barang')
                        <a href="{{ route('barang.create') }}"
                            class="inline-flex items-center justify-center px-5 py-3 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out w-full sm:w-auto">
                            <i class="fas fa-plus mr-2"></i> Tambah Barang
                        </a>
                        <!-- Tombol untuk membuka modal -->
                        <a href="{{ route('upload-barang.index') }}"
                            class="inline-flex items-center justify-center px-5 py-3 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-red-300 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out w-full sm:w-auto">
                            <i class="fas fa-plus mr-2"></i> Upload Excel
                        </a>
                    @endcan

                    @can('Tambah Kategori')
                        <a href="{{ route('kategori.index') }}"
                            class="inline-flex items-center justify-center px-5 py-3 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-400 text-gray-800 font-semibold rounded-lg shadow-md transition duration-200 ease-in-out w-full sm:w-auto">
                            <i class="fas fa-tags mr-2"></i> Tambah Kategori
                        </a>
                    @endcan

                </div>
                <div class="container mx-auto p-4">
                    <div class="mb-4 text-right">
                        <button id="toggleViewBtn" class="btn btn-secondary px-4 py-2 rounded">
                            Ganti ke Tampilan Bergambar
                        </button>
                    </div>
                    <div id="viewWithImage" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 hidden">
                        <!-- Card 1 -->
                        @foreach ($categories as $category)
                            <div class="bg-white rounded-lg shadow-xl p-4 hover:scale-105 hover:transition-all cursor-pointer"
                                onclick="window.location='{{ route('barang.by-category', $category->id_kategori) }}'">
                                <div class="text-xl font-bold mb-4 inset-0 text-center">
                                    {{ $category->nama }}
                                </div>
                                <div class="flex justify-center items-center inset-0 mb-3">
                                    <a>

                                        <img alt="{{ $category->nama }}"
                                            class="aspect-[6/4] w-full rounded-lg opacity-85 object-cover"
                                            src="{{ asset('storage/' . $category->image) }}" />
                                    </a>
                                </div>
                                <div class="text-center space-y-2">
                                    {{-- Tombol Edit --}}
                                    @can('Edit Kategori')
                                        <button type="button"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition duration-200 font-semibold"
                                            onclick="event.stopPropagation(); window.location.href='{{ route('kategori.edit', $category->id_kategori) }}'">
                                            {{-- Icon Edit --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5h10M3 5h4m4 0v14m0 0H5a2 2 0 01-2-2V7a2 2 0 012-2h10m0 0v14" />
                                            </svg>
                                            Edit
                                        </button>
                                    @endcan

                                    {{-- Tombol Delete --}}
                                    @can('Hapus Kategori')
                                        <button type="button"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition duration-200 font-semibold delete-btn"
                                            onclick="event.stopPropagation()" data-id="{{ $category->id_kategori }}">
                                            {{-- Icon Delete --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Delete
                                        </button>
                                    @endcan
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div id="viewWithoutImage" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($categories as $category)
                            <div onclick="window.location.href='{{ route('barang.by-category', $category->id_kategori) }}'"
                                class="group bg-white rounded-lg shadow-md p-6 flex flex-col justify-between cursor-pointer hover:ring-2 hover:ring-blue-600 transition">

                                <div class="pointer-events-none">
                                    <h2 class="text-2xl font-semibold text-center text-gray-900 mb-2 truncate"
                                        title="{{ $category->nama }}">{{ $category->nama }}</h2>
                                    <p class="text-sm text-white mb-4">ID: {{ $category->id_kategori }}</p>
                                </div>

                                <div class="flex flex-col sm:flex-row justify-center items-center gap-3 mt-4">

                                    @can('Edit Barang')
                                        <button type="button"
                                            class="w-full sm:w-auto px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center justify-center gap-2"
                                            onclick="event.stopPropagation(); window.location.href='{{ route('kategori.edit', $category->id_kategori) }}'"
                                            aria-label="Edit {{ $category->nama }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    @endcan

                                    @can('Hapus Barang')
                                        <button type="button"
                                            class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition flex items-center justify-center gap-2 delete-btn"
                                            data-id="{{ $category->id_kategori }}" onclick="event.stopPropagation()"
                                            aria-label="Delete {{ $category->nama }}">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                <script>
                    const toggleBtn = document.getElementById('toggleViewBtn');
                    const viewWithImage = document.getElementById('viewWithImage');
                    const viewWithoutImage = document.getElementById('viewWithoutImage');
                    let isImageView = false;

                    toggleBtn.addEventListener('click', () => {
                        isImageView = !isImageView;

                        viewWithImage.classList.toggle('hidden', !isImageView);
                        viewWithoutImage.classList.toggle('hidden', isImageView);

                        toggleBtn.textContent = isImageView ? 'Ganti Tampilan' : 'Ganti ke Tampilan Bergambar';
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const deleteKategoriUrl = "{{ route('kategori.destroy') }}"
</script>
