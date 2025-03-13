<script>
    // Function to toggle dropdown and store its state
    function toggleDropdown(id) {
        var element = document.getElementById(id);
        element.classList.toggle('hidden');
        element.classList.toggle('block');

        var chevron = element.previousElementSibling.querySelector('.fa-chevron-down');
        chevron.classList.toggle('rotate-180');

        // Simpan state ke localStorage
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

<style>
    .rotate-180 {
        transform: rotate(180deg);
    }
</style>

<div class="w-64 bg-white h-full shadow-lg">
    <div class="p-6">
        <div class="flex flex-col items-start">
            <span class="text-xl font-bold text-red-600">
                {{ Auth::user()->name }}
            </span>
            <p class="text-sm font-bold">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</p>
            <hr class="my-3 border-black border-t-2">
        </div>
        <nav>
            <nav>
                <ul class="font-sans">
                    <li class="mb-2">
                        <x-responsive-sub-menu :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="fas fa-home">
                            {{ __('Dashboard') }}
                        </x-responsive-sub-menu>
                    </li>
                    <li class="mb-2">
                        <button onclick="toggleDropdown('reference-menu')"
                            class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 tracking-wide transition-all mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-folder-open mr-3"></i>
                                Referensi
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul id="reference-menu" class="hidden pl-6">
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('barang.index')" :active="request()->routeIs('barang.*')" icon="fas fa-box">
                                    {{ __('Barang') }}
                                </x-responsive-sub-menu>
                            </li>
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('supplier.index')" :active="request()->routeIs('supplier.*')" icon="fas fa-user-tie">
                                    {{ __('Data Supplier') }}
                                </x-responsive-sub-menu>
                            </li>
                        </ul>
                    </li>

                    <li class="mb-2">
                        <button onclick="toggleDropdown('transaction-menu')"
                            class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 tracking-wide transition-all mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-money-bill mr-3"></i>
                                Transaksi
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul id="transaction-menu" class="hidden pl-6">
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('pengadaan.index')" :active="request()->routeIs('pengadaan.*')" icon="fas fa-cube">
                                    {{ __('Permintaan Pengadaan') }}
                                </x-responsive-sub-menu>
                            </li>
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('pembelian.index')" :active="request()->routeIs('pembelian.*')" icon="fas fa-shopping-cart ">
                                    {{ __('Pembelian') }}
                                </x-responsive-sub-menu>
                            </li>
                        </ul>
                    </li>

                    <li class="mb-2">
                        <button onclick="toggleDropdown('report-menu')"
                            class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 tracking-wide transition-all mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-money-bill mr-3"></i>
                                Laporan
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul id="report-menu" class="hidden pl-6">
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('dashboard')" :active="request()->routeIs('invoice')" icon="fas fa-file-invoice">
                                    {{ __('Invoice') }}
                                </x-responsive-sub-menu>
                            </li>
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('dashboard')" :active="request()->routeIs('monthly-report')"
                                    icon="fas fa-file-contract ">
                                    {{ __('Laporan Bulanan') }}
                                </x-responsive-sub-menu>
                            </li>
                            <li class="mb-2">
                                <x-responsive-sub-menu :href="route('dashboard')" :active="request()->routeIs('daily-report')"
                                    icon="fas fa-clipboard-list">
                                    {{ __('Laporan Harian') }}
                                </x-responsive-sub-menu>
                            </li>
                        </ul>
                    </li>

                    <li class="mb-2">
                        <button onclick="toggleDropdown('utility-menu')"
                            class="flex items-center justify-between w-full text-gray-700 hover:text-white hover:bg-red-500 rounded-lg p-2 tracking-wide transition-all mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-tools mr-3"></i>
                                Utility
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul id="utility-menu" class="hidden pl-6">
                            @can('Manajemen Menu')
                                <li class="mb-2">
                                    <x-responsive-sub-menu :href="route('permissions.index')" :active="request()->routeIs('permissions.*')"
                                        icon="fas fa-tachometer-alt">
                                        {{ __('Manajemen Menu') }}
                                    </x-responsive-sub-menu>
                                </li>
                            @endcan
                            @can('Manajemen Role')
                                <li class="mb-2">
                                    <x-responsive-sub-menu :href="route('roles.index')" :active="request()->routeIs('roles.*')"
                                        icon="fas fa-tachometer-alt">
                                        {{ __('Manajemen Role') }}
                                    </x-responsive-sub-menu>
                                </li>
                            @endcan
                            @can('Manajemen User')
                                <li class="mb-2">
                                    <x-responsive-sub-menu :href="route('users.index')" :active="request()->routeIs('users.*')"
                                        icon="fas fa-tachometer-alt">
                                        {{ __('Manajemen User') }}
                                    </x-responsive-sub-menu>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>

            </nav>
    </div>
</div>
