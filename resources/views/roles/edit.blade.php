<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
                <h1 class="text-white text-lg font-semibold truncate">Manajemen Role / Edit Role</h1>
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
                            <a class="text-gray-700 pb-2" href="{{ route('roles.create') }}">
                                Membuat Role
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-700 pb-2" href="{{ route('roles.index') }}">
                                List Role
                            </a>
                        </li>
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 pb-2 cursor-default" href="">
                                Edit Role
                            </p>
                        </li>
                    </ul>
                </nav>
                <section>
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-4 w-full">
                        @csrf
                        <div>
                            <label for="roles" class="block text-sm font-medium text-gray-700">Nama Role</label>
                            <input type="text" id="buat-role" name="name" value="{{ old('name', $role->name) }}"
                                placeholder="Role"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            @error('name')
                                <p class="text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kontainer permission yang bisa discroll --}}
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 max-h-[480px] overflow-y-auto pr-2 mb-6">
                            @php
                                $permissionGroups = [
                                    'Barang' => [
                                        'Akses Menu Barang',
                                        'Tambah Barang',
                                        'Edit Barang',
                                        'Hapus Barang',
                                        'Tambah kategori',
                                        'Edit Kategori',
                                        'Hapus Kategori',
                                    ],
                                    'Supplier' => [
                                        'Akses Menu Supplier',
                                        'Tambah Supplier',
                                        'Hapus Supplier',
                                        'Edit Supplier',
                                    ],
                                    'Permintaan Pengadaan' => ['Akses Menu Permintaan Pengadaan'],
                                    'Pembelian' => [
                                        'Ubah Status Pengadaan',
                                        'Hapus Pengadaan',
                                        'Akses Menu Pembelian',
                                        'Download PDF',
                                    ],
                                    'Invoice' => ['Akses Menu Invoice', 'Download Invoice', 'Detail Invoice'],
                                    'Laporan Harian' => ['Akses Menu laporan harian', 'Download Laporan Harian'],
                                    'Laporan Bulanan' => ['Akses Menu laporan bulanan', 'Download Laporan Bulanan'],
                                    'Manajemen Role' => [
                                        'Akses Menu Manajemen Role',
                                        'Tambah Role',
                                        'Edit Role',
                                        'Hapus Role',
                                    ],
                                    'Manajemen User' => [
                                        'Akses Menu Manajemen User',
                                        'Tambah User',
                                        'Edit User',
                                        'Hapus User',
                                    ],
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
                                                    <input
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}
                                                        type="checkbox" id="permission-{{ $permission->id }}"
                                                        name="permission[]" value="{{ $permission->name }}"
                                                        class="form-checkbox h-5 w-5 text-red-600 rounded focus:ring-red-500 permission-checkbox"
                                                        data-group="{{ $label }}"
                                                        data-permission="{{ $permission->name }}" />
                                                    <span
                                                        class="ml-2 text-gray-800 text-sm">{{ $permission->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                @endif
                            @endforeach

                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-red-500 text-white p-2 rounded-md hover:bg-red-600">Update</button>
                        </div>


                    </form>
                </section>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengaktifkan/menonaktifkan checkbox dalam grup
            function toggleGroup(groupNames, enable) {
                groupNames.forEach(function(group) {
                    $(`.permission-checkbox[data-group="${group}"]`).each(function() {
                        const perm = $(this).data('permission')?.toLowerCase();

                        if (!perm.includes('akses menu')) {
                            $(this).prop('disabled', !enable);

                            // Jangan auto-uncheck jika sudah dicentang
                            if (!enable && !$(this).is(':checked')) {
                                $(this).prop('checked', false);
                            }
                        }
                    });
                });
            }

            // Saat checkbox berubah
            $('.permission-checkbox').on('change', function() {
                const permission = $(this).data('permission')?.toLowerCase();
                const group = $(this).data('group');

                if (!permission || !group) return;

                if (permission.includes('akses menu')) {
                    const isChecked = $(this).is(':checked');

                    if (group === 'Barang') {
                        toggleGroup(['Barang', 'Kategori'], isChecked);
                    } else {
                        toggleGroup([group], isChecked);
                    }
                }
            });

            // Inisialisasi saat halaman pertama dimuat
            const uniqueGroups = new Set();
            $('.permission-checkbox').each(function() {
                const group = $(this).data('group');
                if (group) uniqueGroups.add(group);
            });

            uniqueGroups.forEach(function(group) {
                const masterCheckbox = $(`.permission-checkbox[data-group="${group}"]`).filter(function() {
                    return $(this).data('permission')?.toLowerCase().includes('akses menu');
                });

                const otherChecked = $(`.permission-checkbox[data-group="${group}"]`).filter(function() {
                    const perm = $(this).data('permission')?.toLowerCase();
                    return !perm.includes('akses menu') && $(this).is(':checked');
                });

                // Jika ada permission lain yang dicentang, pastikan akses menu ikut dicentang
                if (otherChecked.length > 0) {
                    masterCheckbox.prop('checked', true);
                }

                const isChecked = masterCheckbox.is(':checked');

                if (group === 'Barang') {
                    toggleGroup(['Barang', 'Kategori'], isChecked);
                } else {
                    toggleGroup([group], isChecked);
                }
            });
        });
    </script>




</body>

</html>
