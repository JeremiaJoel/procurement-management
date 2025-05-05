<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Role</title>
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
                <h1 class="text-white text-lg font-semibold truncate">Manajemen Role / Tambah Role</h1>
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
                <x-message></x-message>
                <nav class="mb-6">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-red-600 border-b-2 border-red-600 pb-2 cursor-default" href="    ">
                                Membuat Role
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-700 pb-2" href="{{ route('roles.index') }}">
                                List Role
                            </a>
                        </li>
                        <li>
                            <p class="cursor-default" href="">
                                Edit Role
                            </p>
                        </li>
                    </ul>
                </nav>
                <section>
                    <form action="{{ route('roles.create') }}" method="POST" class="space-y-4 w-full">
                        @csrf
                        <div>
                            <label for="roles" class="block text-sm font-medium text-gray-700">Nama Role</label>
                            <input type="text" id="buat-role" name="name" value="{{ old('name') }}"
                                placeholder="Role"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            @error('role')
                                <p class="text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kontainer permission yang bisa discroll --}}
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 max-h-[480px] overflow-y-auto pr-2 mb-6">
                            @php
                                $permissionGroups = [
                                    'Barang' => ['Lihat Barang', 'Tambah Barang', 'Edit Barang', 'Hapus Barang'],
                                    'Kategori' => ['Tambah kategori', 'Edit Kategori', 'Hapus Kategori'],
                                    'Supplier' => ['Lihat Supplier', 'Tambah Supplier', 'Hapus Supplier'],
                                    'Permintaan Pengadaan' => ['Lihat Permintaan Pengadaan'],
                                    'Pembelian' => [
                                        'Ubah Status Pengadaan',
                                        'Hapus Pengadaan',
                                        'Lihat Pembelian',
                                        'Download Pembelian',
                                    ],
                                    'Invoice' => ['Lihat Invoice', 'Download Invoice', 'Hapus Invoice'],
                                    'Laporan Harian' => ['Lihat laporan harian'],
                                    'Laporan Bulanan' => ['Lihat laporan bulanan'],
                                    'Utility' => ['Manajemen Role', 'Manajemen User'],
                                ];
                            @endphp

                            @foreach ($permissionGroups as $label => $keywords)
                                @php
                                    $filtered = $permissions->filter(function ($permission) use ($keywords) {
                                        foreach ($keywords as $keyword) {
                                            if (Str::contains(Str::lower($permission->name), Str::lower($keyword))) {
                                                return true;
                                            }
                                        }
                                        return false;
                                    });
                                @endphp

                                @if ($filtered->isNotEmpty())
                                    <fieldset class="border border-gray-300 rounded-md p-4 bg-gray-50 flex flex-col">
                                        <legend class="mb-3 text-base font-semibold text-gray-700 px-1">
                                            {{ $label }}</legend>
                                        <div class="flex flex-col space-y-2 max-h-48 overflow-y-auto pr-1">
                                            @foreach ($filtered as $permission)
                                                <label for="permission-{{ $permission->id }}"
                                                    class="inline-flex items-center cursor-pointer select-none">
                                                    <input type="checkbox" id="permission-{{ $permission->id }}"
                                                        name="permission[]" value="{{ $permission->name }}"
                                                        class="form-checkbox h-5 w-5 text-red-600 rounded focus:ring-red-500" />
                                                    <span
                                                        class="ml-2 text-gray-800 text-sm">{{ $permission->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                @endif
                            @endforeach
                        </div>

                        {{-- Tombol Submit di luar div scroll --}}
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
