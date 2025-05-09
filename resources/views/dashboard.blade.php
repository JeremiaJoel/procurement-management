<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.8/countUp.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body class="bg-blue-900 font-sans font-semibold">
    @include('layouts.loader')

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar-new')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative z-10">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900"></div>
            <header class="flex justify-between items-center mb-6 relative z-10 rounded-md">
                <button id="sidebarToggle" aria-label="Toggle sidebar"
                    class="text-white focus:outline-none mr-6 lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="text-white text-lg font-semibold truncate">Dashboard</h1>
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
            <div class="bg-white p-6 rounded-lg shadow-lg relative z-10 min-h-screen">

                <section class="mb-6">
                    <h2 class="text-xl font-bold mb-4">
                        Overview
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold" id="jumlahBarang">
                                        {{ $data['jumlahBarang'] }}
                                    </h3>
                                    <p class="text-gray-600">
                                        Total Barang
                                    </p>
                                </div>
                                <i class="fas text-blue-400 fa-2x fa-box"></i>
                            </div>
                            @can('Lihat Barang')
                                <a class="text-red-600 flex items-center hover:text-blue-900"
                                    href="{{ route('barang.index') }}">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            @endcan

                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold " id="jumlahSupplier">
                                        {{ $data['jumlahSupplier'] }}
                                    </h3>
                                    <p class="text-gray-600">
                                        Total Supplier
                                    </p>
                                </div>
                                <svg class="w-9 h-9 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            @can('Lihat Supplier')
                                <a class="text-red-600 flex items-center hover:text-blue-500"
                                    href="{{ route('supplier.index') }}">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            @endcan

                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        {{ $data['jumlahPengadaan'] }}
                                    </h3>
                                    <p class="text-gray-600">
                                        Total Pengadaan
                                    </p>
                                </div>
                                <i class="fas fa-clipboard-list text-blue-500 text-3xl"></i>
                            </div>
                            <a class="text-red-600 flex items-center  hover:text-blue-500"
                                href="{{ route('pembelian.index') }}">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        {{-- <div class="bg-white p-4 rounded-lg shadow-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        1
                                    </h3>
                                    <p class="text-gray-600">
                                        Material Outstanding
                                    </p>
                                </div>
                                <i class="fas fa-star text-green-500 text-3xl"></i>
                            </div>
                            <a class="text-red-600 flex items-center" href="#">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div> --}}
                    </div>
                </section>
                <section class="mb-6">
                    <div class="flex gap-4">
                        <!-- Kiri -->
                        <div class="w-1/2 h-[430px] bg-gray-50 border-2 border-gray-300 rounded-lg p-4 flex flex-col">
                            <h2 class="text-lg font-bold text-gray-700 mb-2 text-center">Barang Per Kategori</h2>
                            <div class="flex-1">
                                <canvas id="barangPerKategori" class="w-full h-full"></canvas>
                            </div>
                            <script>
                                const ctx = document.getElementById('barangPerKategori');

                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: {!! json_encode($namaKategori) !!},
                                        datasets: [{
                                            label: 'Jumlah Barang',
                                            data: {!! json_encode($jumlahBarangPerKategori) !!},
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        responsive: true,
                                        maintainAspectRatio: false,
                                    }
                                });
                            </script>
                        </div>

                        <!-- Kanan -->
                        <div
                            class="w-1/2 h-[430px] bg-gray-50 border-2 border-gray-300 rounded-lg p-4 flex flex-col overflow-hidden">
                            <h2 class="text-lg font-bold text-gray-700 mb-2 text-center">Pengadaan Barang</h2>
                            <div class="flex-1 relative">
                                <canvas id="pengadaanChart" class="absolute inset-0 w-full h-full"></canvas>
                            </div>
                            <script>
                                const ctx2 = document.getElementById('pengadaanChart');

                                new Chart(ctx2, {
                                    type: 'pie',
                                    data: {
                                        labels: {!! json_encode($labelPengadaan) !!},
                                        datasets: [{
                                            label: 'Jumlah Pengadaan',
                                            data: {!! json_encode($jumlahPengadaan) !!},
                                            backgroundColor: ['#4CAF50', '#FF9800'],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                    }
                                });
                            </script>
                        </div>



                    </div>
                </section>


            </div>
        </div>
    </div>
</body>

</html>
<script>
    function animateCount(id, target, duration = 600) {
        const el = document.getElementById(id);
        const stepTime = 20;
        const totalSteps = duration / stepTime;
        let current = 0;
        const increment = target / totalSteps;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                el.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                el.textContent = Math.floor(current).toLocaleString();
            }
        }, stepTime);
    }

    document.addEventListener('DOMContentLoaded', function() {
        animateCount('jumlahBarang', {{ $data['jumlahBarang'] ?? 0 }});
        animateCount('jumlahSupplier', {{ $data['jumlahSupplier'] ?? 0 }});
        // animateCount('jumlahUser', {{ $data['jumlahUser'] ?? 0 }});
        // Tambah lagi sesuai kebutuhan
    });
</script>
