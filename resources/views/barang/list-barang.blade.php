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

<body class="bg-gray-100 font-sans font-semibold">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 100%)">
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
                            <a class="text-gray-500 pb-2" href="{{ route('barang.index') }}">
                                List Kategori Barang
                            </a>
                        </li>
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 pb-2" href="">
                                List Barang {{ $category->nama }}
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


                    </ul>
                </nav>
                <div class="container mx-auto p-4 font-sans font-semibold ">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Card 1 -->
                        @foreach ($barangs as $barang)
                            <div class="bg-white rounded-lg shadow-xl p-9">
                                <div class="text-xl mb-4 inset-0 text-center">
                                    {{ $barang->nama }}
                                </div>
                                <div class="flex justify-center items-center inset-0">
                                    <div class="w-full aspect-square overflow-hidden rounded-md border border-blue-300">
                                        <!-- aspect-square untuk rasio 1:1 -->
                                        <img alt="{{ $barang->nama }}" class="h-auto object-fill"
                                            src="{{ asset('storage/' . $barang->image) }}" />
                                    </div>
                                </div>
                                <div class="p-3 m-2 text-center tracking-wider">
                                    <button class="btn btn-primary btn-detail" data-id="{{ $barang->barang_id }}">
                                        Detail
                                    </button>
                                    <button type="button" class="btn btn-success"
                                        onclick="window.location.href='{{ route('barang.edit', $barang->barang_id) }}'">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger delete-btn"
                                        data-id="{{ $barang->barang_id }}">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modals.modal-barang')

</body>

</html>
