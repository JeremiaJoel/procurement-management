<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sidebar Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-64 bg-white h-screen shadow-lg flex flex-col">
        <div class="flex items-center justify-center h-14 border-b">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 mr-3">
            <span class="text-gray-900 font-semibold text-lg select-none">
                VicProc
            </span>
        </div>


        <div class="overflow-y-auto overflow-x-hidden flex-grow">
            <ul class="flex flex-col py-4 space-y-1">

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
                        {{ request()->routeIs('dashboard') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                        <span class="inline-flex justify-center items-center ml-4 ">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                    </a>
                </li>

                @canany(['Lihat Barang', 'Lihat Supplier'])
                    <li class="px-4">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-light tracking-wide text-gray-500">Referensi</div>
                        </div>
                    </li>
                @endcanany
                @can('Lihat Barang')
                    <li>
                        <a href="{{ route('barang.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
   {{ request()->routeIs(['barang.*', 'kategori.*']) ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">

                                <i class="fas fa-box"></i>
                            </span>
                            <span class="ml-3 text-sm tracking-wide truncate">Barang</span>
                        </a>
                    </li>
                @endcan

                @can('Lihat Supplier')
                    <li>
                        <a href="{{ route('supplier.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
                        {{ request()->routeIs('supplier.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Data Supplier</span>

                        </a>
                    </li>
                @endcan
                @canany(['Lihat Permintaan Pengadaan', 'Lihat Pembelian'])
                    <li class="px-4">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-light tracking-wide text-gray-500">Transaksi</div>
                        </div>
                    </li>
                @endcanany

                @can('Lihat Permintaan Pengadaan')
                    <li>
                        <a href="{{ route('pengadaan.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
            {{ request()->routeIs('pengadaan.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-cube"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Permintaan Pengadaan</span>
                        </a>
                    </li>
                @endcan

                @can('Lihat Pembelian')
                    <li>
                        <a href="{{ route('pembelian.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
            {{ request()->routeIs('pembelian.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Pembelian</span>
                        </a>
                    </li>
                @endcan

                @canany(['Lihat Invoice', 'Lihat Laporan Harian', 'Lihat Laporan Bulanan'])
                    <li class="px-4">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-light tracking-wide text-gray-500">Laporan</div>
                        </div>
                    </li>
                @endcanany

                @can('Lihat Invoice')
                    <li>
                        <a href="{{ route('invoice.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
                        {{ request()->routeIs('invoice.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-file-invoice"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Invoice</span>
                        </a>
                    </li>
                @endcan

                @can('Lihat Laporan Harian')
                    <li>
                        <a href="{{ route('laporan-harian.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
                        {{ request()->routeIs('laporan-harian.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-clipboard-list"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Laporan Harian</span>
                        </a>
                    </li>
                @endcan

                @can('Lihat Laporan Bulanan')
                    <li>
                        <a href="{{ route('laporan-bulanan.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 pr-6 
                        {{ request()->routeIs('laporan-bulanan.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fas fa-clipboard-list"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Laporan Bulanan</span>
                        </a>
                    </li>
                @endcan

                @canany(['Manajemen Utilitas', 'Manajemen Role', 'Manajemen User'])
                    <li class="px-4">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-light tracking-wide text-gray-500">Utility</div>
                        </div>
                    </li>
                @endcanany

                @can('Manajemen Utilitas')
                    <li>
                        <a href="{{ route('permissions.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 p-4 
                        {{ request()->routeIs('permissions.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent  ' }}">
                            <i class="fas fa-clipboard-list"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Manajemen Utilitas</span>
                        </a>
                    </li>
                @endcan

                @can('Manajemen Role')
                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 p-4 
                    {{ request()->routeIs('roles.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <i class="fas fa-clipboard-list"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Manajemen Role</span>
                        </a>
                    </li>
                @endcan

                @can('Manajemen User')
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 p-4 
                    {{ request()->routeIs('users.*') ? 'border-l-4 border-red-500 bg-gray-50 text-gray-800' : 'border-l-4 border-transparent' }}">
                            <i class="fas fa-clipboard-list"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Manajemen User</span>
                        </a>
                    </li>
                @endcan

                <li class="border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-red-500 pr-6 ">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
                        </button>
                    </form>

                </li>
            </ul>
        </div>
    </div>
</body>

</html>
