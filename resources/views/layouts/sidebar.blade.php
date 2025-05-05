<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sidebar Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-gray-100">
    <script>
        // Function to toggle dropdown and store its state
        function toggleDropdown(id) {
            var element = document.getElementById(id);
            element.classList.toggle('hidden');
            element.classList.toggle('block');

            var chevron = element.previousElementSibling.querySelector('.fa-chevron-down');
            chevron.classList.toggle('rotate-180');

            // Save state to localStorage
            if (element.classList.contains('block')) {
                localStorage.setItem(id, 'open');
            } else {
                localStorage.setItem(id, 'closed');
            }
        }

        // Function to restore dropdown state
        function restoreDropdownState() {
            const dropdowns = document.querySelectorAll('ul[id]');
            dropdowns.forEach(dropdown => {
                const id = dropdown.id;
                const state = localStorage.getItem(id);

                if (state === 'open') {
                    dropdown.classList.remove('hidden');
                    dropdown.classList.add('block');
                    const chevron = dropdown.previousElementSibling.querySelector('.fa-chevron-down');
                    chevron.classList.add('rotate-180');
                } else {
                    dropdown.classList.remove('block');
                    dropdown.classList.add('hidden');
                }
            });
        }

        // Restore dropdown state on page load
        document.addEventListener('DOMContentLoaded', restoreDropdownState);
    </script>

    <aside class="w-64 bg-white h-screen shadow-lg flex flex-col">
        <div class="p-6 border-b border-gray-300 flex flex-col items-start space-y-1">
            <span class="text-2xl font-extrabold text-red-600 truncate max-w-full">
                {{ Auth::user()->name }}
            </span>
            <p class="text-sm font-semibold text-gray-600 truncate max-w-full">
                {{ Auth::user()->roles->pluck('name')->implode(', ') }}
            </p>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="mt-2 w-full bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-md py-2 px-4 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                    Logout
                </button>
            </form>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 py-6">
            <ul class="font-sans space-y-4">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-semibold {{ request()->routeIs('dashboard') ? 'bg-red-500 text-white' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <button onclick="toggleDropdown('reference-menu')"
                        class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 font-semibold transition-colors">
                        <span class="flex items-center space-x-3">
                            <i class="fas fa-folder-open"></i>
                            <span>Referensi</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <ul id="reference-menu" class="hidden pl-8 mt-2 space-y-2">
                        <li>
                            <a href="{{ route('barang.index') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('barang.*') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-box"></i>
                                <span>Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('supplier.index') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('supplier.*') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-user-tie"></i>
                                <span>Data Supplier</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button onclick="toggleDropdown('transaction-menu')"
                        class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 font-semibold transition-colors">
                        <span class="flex items-center space-x-3">
                            <i class="fas fa-money-bill"></i>
                            <span>Transaksi</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <ul id="transaction-menu" class="hidden pl-8 mt-2 space-y-2">
                        <li>
                            <a href="{{ route('pengadaan.index') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('pengadaan.*') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-cube"></i>
                                <span>Permintaan Pengadaan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pembelian.index') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('pembelian.*') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Pembelian</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button onclick="toggleDropdown('report-menu')"
                        class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 font-semibold transition-colors">
                        <span class="flex items-center space-x-3">
                            <i class="fas fa-file-alt"></i>
                            <span>Laporan</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <ul id="report-menu" class="hidden pl-8 mt-2 space-y-2">
                        <li>
                            <a href="{{ route('invoice.index') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('invoice.*') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-file-invoice"></i>
                                <span>Invoice</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('laporan-harian.index') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('laporan-harian.*') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Laporan Harian</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('') ? 'bg-red-500 text-white' : '' }}">
                                <i class="fas fa-file-contract"></i>
                                <span>Laporan Bulanan</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button onclick="toggleDropdown('utility-menu')"
                        class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 font-semibold transition-colors">
                        <span class="flex items-center space-x-3">
                            <i class="fas fa-tools"></i>
                            <span>Utility</span>
                        </span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <ul id="utility-menu" class="hidden pl-8 mt-2 space-y-2">
                        @can('Manajemen Menu')
                            <li>
                                <a href="{{ route('permissions.index') }}"
                                    class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('permissions.*') ? 'bg-red-500 text-white' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Manajemen Menu</span>
                                </a>
                            </li>
                        @endcan
                        @can('Manajemen Role')
                            <li>
                                <a href="{{ route('roles.index') }}"
                                    class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('roles.*') ? 'bg-red-500 text-white' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Manajemen Role</span>
                                </a>
                            </li>
                        @endcan
                        @can('Manajemen User')
                            <li>
                                <a href="{{ route('users.index') }}"
                                    class="flex items-center space-x-3 text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 transition-colors font-medium {{ request()->routeIs('users.*') ? 'bg-red-500 text-white' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Manajemen User</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
</body>

</html>
