<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Permintaan Pengadaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/pengadaan.js'])

</head>

<body class="bg-blue-900 font-sans font-semibold">
    @include('layouts.loader')


    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar-new')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative">

            <!-- Background Design -->
            <div class="bg-blue-900 min-h-screen w-full absolute top-0 left-0 -z-10">
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
                <h1 class="text-white text-lg font-semibold truncate">Permintaan Pengadaan</h1>
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
                    </ul>
                </nav>
                <div class="flex space-x-6">
                    <!-- Left Component: Table -->
                    <section class="w-1/2 bg-gray-50 p-6 rounded-lg shadow-lg">
                        <h2 class="font-bold mb-4">List Barang</h2>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Pilih Kategori</label>
                            <select id="category" class="w-full border border-gray-300 rounded px-2 py-2">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id_kategori }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Add Barang</label>
                            <select id="select-barang" class="w-full border border-gray-300 rounded px-2 py-2">
                                <option value="">Daftar Barang</option>
                            </select>
                        </div>

                    </section>

                    <!-- Right Component: Additional Content -->
                    <section class="w-1/2 bg-gray-50 p-6 rounded-lg shadow-lg">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Nama Pengadaan</label>
                            <input id="nama-pengadaan" class="w-full border border-gray-300 rounded px-2 py-2">
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg font-sans font-semibold">
                            <table class="w-full text-sm text-left rtl:text-right text-black">
                                <thead class="text-xs text-white uppercase bg-red-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Barang
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Kuantitas
                                        </th>
                                        <th scope="col" class="px-6 py-3">Harga</th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="mt-4 font-semibold font-sans text-lg">
                                Total Harga: <span id="totalHarga">Rp. 0</span>
                            </div>
                            <div class="px-6 py-4 text-right">
                                <label class="text-gray-700 mb-2 mx-2">Biaya PPN</label>
                                <input id="biayaPpn" class="ppn-input bg-gray-100 px-2 py-1 rounded w-32 text-right"
                                    value="">
                            </div>
                        </div>
                        <div class="my-4">
                            <label class="block text-gray-700 mb-2">Tanggal</label>
                            <input id="tanggal" type="date" class="w-full border border-gray-300 rounded px-2 py-2"
                                value="{{ now()->toDateString() }}" readonly>
                        </div>

                        <div class="my-4">
                            <label class="block text-gray-700 mb-2">Nama Supplier</label>
                            <select id="supplier" class="w-full border border-gray-300 rounded px-2 py-2">
                                <option value="">Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->supplier_id }}">{{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Keterangan</label>
                            <textarea id="keterangan" rows="4" class="w-full border border-gray-300 rounded px-2 py-2 resize-none"></textarea>
                        </div>
                        <div class="relative h-16">
                            <button type="button" id="submit-pengadaan"
                                class="absolute top-0 right-0 btn btn-primary delete-btn m-3 font-semibold font-sans">
                                Submit Pengadaan
                            </button>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const filterBarangUrl = "{{ route('filter.barang') }}"
</script>
