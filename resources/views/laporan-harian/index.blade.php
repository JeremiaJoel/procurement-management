<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Harian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/calendar.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/dist/output.css" rel="stylesheet" />


</head>

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
                    Laporan Harian
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
                <x-message></x-message>
                <nav class="mb-6">
                    <h1 class="inline-block text-xl text-red-600 border-b-2 border-red-600">
                        Rekap Laporan Harian
                    </h1>
                </nav>
                <form action="{{ route('laporan-harian.index') }}">
                    @include('components.datepicker')
                    <button type="submit" class="px-4 btn btn-success mb-[15px] py-2 text-white rounded font-semibold">
                        Terapkan
                    </button>
                </form>
                <div class="bg-gray-100 rounded p-4">
                    <h2 class="text-2xl mb-4">List Laporan</h2>
                    <p class="mt-4 text-gray-700">
                        Menampilkan data untuk tanggal:
                        <strong>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</strong>

                    </p>
                    <!-- Classes Table -->
                    <div class="relative overflow-auto">
                        <div class="overflow-x-auto rounded-lg">
                            {{-- @if (request('tanggal'))
                                <p class="mt-4 text-gray-700">Menampilkan data untuk tanggal:
                                    <strong>{{ request('tanggal') }}</strong>
                                </p>
                            @endif --}}
                            <table class="min-w-full bg-white border mb-20">
                                <thead>
                                    <tr class="bg-[#2B4DC994] text-center text-xs md:text-sm font-thin text-white">
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">No</span>
                                        </th>
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">Kode Pengadaan</span>
                                        </th>
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">Nama Pengadaan</span>
                                        </th>
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">Total Harga</span>
                                        </th>
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">Status</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pengadaans->isNotEmpty())
                                        @foreach ($pengadaans as $index => $pengadaan)
                                        @endforeach
                                        <tr class="border-b text-xs md:text-sm text-center text-gray-800">
                                            <td class="p-2 md:p-4">iterasi</td>
                                            <td class="p-2 md:p-4">{{ $pengadaan->kode_pengadaan }}</td>
                                            <td class="p-2 md:p-4">{{ $pengadaan->nama_pengadaan }}</td>
                                            <td class="p-2 md:p-4">{{ $pengadaan->total_harga }}</td>
                                            <td class="p-2 md:p-4">{{ $pengadaan->status }}</td>

                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
