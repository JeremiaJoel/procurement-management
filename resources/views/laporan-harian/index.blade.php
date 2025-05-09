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
        <!-- Loader -->
        <div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
            <div class="relative">
                <div class="h-24 w-24 rounded-full border-t-8 border-b-8 border-gray-200"></div>
                <div
                    class="absolute top-0 left-0 h-24 w-24 rounded-full border-t-8 border-b-8 border-blue-500 animate-spin">
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        @include('layouts.sidebar-new')
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-6 relative">
            <!-- Background Design -->
            <div class="absolute inset-0 bg-blue-900" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);">
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
                <h1 class="text-white text-lg font-semibold truncate">Laporan Harian</h1>
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
                    <h2 class="text-xl mb-4">Rekap laporan pengadaan hari:
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                    </h2>

                    <!-- Classes Table -->
                    <div class="shadow-lg rounded-lg overflow-hidden mx-2 md:mx-10">
                        <table class="w-full table-fixed">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">No
                                    </th>
                                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Nama
                                        Pengadaan
                                    </th>
                                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Total
                                        Harga
                                    </th>
                                    <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($pengadaans as $index => $pengadaan)
                                    <tr>
                                        <td class="py-4 px-6 border-b border-gray-200">
                                            {{ $pengadaans->firstItem() + $index }}
                                        </td>
                                        <td class="py-4 px-6 border-b border-gray-200 truncate">
                                            {{ $pengadaan->nama_pengadaan }}
                                        </td>
                                        <td class="py-4 px-6 border-b border-gray-200">
                                            Rp{{ number_format($pengadaan->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6 border-b border-gray-200">
                                            <span
                                                class="px-2 py-1 rounded text-white font-medium 
                                                {{ $pengadaan->status == 'Approved' ? 'bg-green-500' : 'bg-red-500' }}">
                                                {{ $pengadaan->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500 py-6">
                                            Laporan tidak ditemukan pada bulan tersebut.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($pengadaans->isNotEmpty())
                            <div class="m-3 px-4 py-2 flex justify-center">
                                <a href="{{ route('laporan-harian.browser', ['tanggal' => $tanggal]) }}" type="button"
                                    class="btn btn-primary text-center text-white rounded font-semibold">
                                    Download
                                </a>
                            </div>
                        @endif



                        {{ $pengadaans->links() }}
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
<style>
    #loader {
        transition: opacity 0.5s ease;
    }

    #loader.fade-out {
        opacity: 0;
        pointer-events: none;
    }
</style>
