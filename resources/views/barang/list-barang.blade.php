<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/barang.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-blue-900 font-sans font-semibold">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar-new')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative z-10">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%)">
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
                <h1 class="text-white text-lg font-semibold truncate">Barang / {{ $category->nama }}</h1>
                <div class="ml-auto flex items-center space-x-4">
                    <div class="flex flex-col text-right">
                        <span class="text-white font-semibold text-xl leading-tight truncate max-w-[120px]">
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
                            <a class="text-gray-500 pb-2" href="{{ route('barang.index') }}">
                                List Kategori Barang
                            </a>
                        </li>
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 pb-2" href="">
                                List Barang {{ $category->nama }}
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
                    </ul>
                </nav>
                <div class="container mx-auto p-4 font-sans font-semibold">
                    <!-- Tombol Toggle -->
                    <div class="mb-4 text-right">
                        <button id="toggleViewBtn" class="btn btn-secondary px-4 py-2 rounded">
                            Ganti Tampilan
                        </button>
                    </div>

                    <!-- Tampilan 1: Dengan Gambar -->
                    <div id="viewWithImage" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($barangs as $barang)
                            <div class="bg-white rounded-lg shadow-xl p-9 flex flex-col justify-between">
                                <div>
                                    <div class="text-xl mb-4 text-center">
                                        {{ $barang->nama }}
                                    </div>
                                    <div class="flex justify-center items-center mb-4">
                                        <div
                                            class="w-full aspect-square overflow-hidden rounded-md border border-blue-300">
                                            <img alt="{{ $barang->nama }}" class="h-auto object-fill"
                                                src="{{ asset('storage/' . $barang->image) }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-center gap-2 flex-wrap">
                                    <button
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition flex items-center gap-2 btn-detail"
                                        data-id="{{ $barang->barang_id }}"
                                        aria-label="View details of {{ $barang->nama }}">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </button>

                                    @can('Edit Barang')
                                        <button type="button"
                                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center gap-2"
                                            onclick="window.location.href='{{ route('barang.edit', $barang->barang_id) }}'"
                                            aria-label="Edit {{ $barang->nama }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    @endcan

                                    @can('Hapus Barang')
                                        <button type="button"
                                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition flex items-center gap-2 delete-btn"
                                            data-id="{{ $barang->barang_id }}" aria-label="Delete {{ $barang->nama }}">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Tampilan 2: Tanpa Gambar -->
                    <div id="viewWithoutImage" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 hidden">
                        @foreach ($barangs as $barang)
                            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 mb-2 truncate"
                                        title="{{ $barang->nama }}">{{ $barang->nama }}</h2>
                                    <p class="text-sm text-gray-500 mb-4">ID: {{ $barang->barang_id }}</p>
                                </div>
                                <div class="flex justify-center gap-3">
                                    <button
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition flex items-center gap-2 btn-detail"
                                        data-id="{{ $barang->barang_id }}"
                                        aria-label="View details of {{ $barang->nama }}">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </button>
                                    @can('Edit Barang')
                                        <button type="button"
                                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center gap-2"
                                            onclick="window.location.href='{{ route('barang.edit', $barang->barang_id) }}'"
                                            aria-label="Edit {{ $barang->nama }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    @endcan
                                    @can('Hapus Barang')
                                        <button type="button"
                                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition flex items-center gap-2 delete-btn"
                                            data-id="{{ $barang->barang_id }}" aria-label="Delete {{ $barang->nama }}">
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
                    let isImageView = true;

                    toggleBtn.addEventListener('click', () => {
                        isImageView = !isImageView;

                        viewWithImage.classList.toggle('hidden', !isImageView);
                        viewWithoutImage.classList.toggle('hidden', isImageView);

                        toggleBtn.textContent = isImageView ? 'Ganti Tampilan' : 'Kembali ke Tampilan Bergambar';
                    });
                </script>

            </div>
        </div>
    </div>
    @include('components.modals.modal-barang')

</body>

</html>
<script>
    const deleteBarangUrl = "{{ route('barang.destroy') }}"
</script>
