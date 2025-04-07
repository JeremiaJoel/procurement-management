<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/kategori.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<!-- resources/views/permissions/index.blade.php -->


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
                    Menu Barang
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
