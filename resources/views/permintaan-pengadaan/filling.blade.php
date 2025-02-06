<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Supplier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/pengadaan.js'])

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
                    Permintaan Pengadaan
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
                    <ul class="flex space-x-6">
                    </ul>
                </nav>
                <div class="flex space-x-6">
                    <!-- Left Component: Table -->
                    <section class="w-1/2 bg-gray-50 p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-4">List Barang</h2>
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Select
                                Category</label>
                            <select id="category" name="kategori"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id_kategori }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Barang</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody id="barang-table-body"
                                class="bg-white divide-y divide-gray-200 font-sans font-semibold">
                                @foreach ($barangs as $index => $barang)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $barang->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <!-- Tambahkan aksi di sini -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>

                    <!-- Right Component: Additional Content -->
                    <section class="w-1/2 bg-gray-50 p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-bold mb-4">Additional Information</h2>
                        <p class="mb-4">Here you can add any additional information or components that you want to
                            display alongside the supplier table.</p>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Statistics</h3>
                            <ul class="list-disc pl-5">
                                <li>Total Suppliers: 150</li>
                                <li>Active Suppliers: 120</li>
                                <li>Inactive Suppliers: 30</li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Recent Activities</h3>
                            <ul class="list-disc pl-5">
                                <li>Supplier A added on 2023-10-01</li>
                                <li>Supplier B updated on 2023-10-02</li>
                                <li>Supplier C removed on 2023-10-03</li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Notifications</h3>
                            <ul class="list-disc pl-5">
                                <li>New supplier request pending approval</li>
                                <li>Supplier D contract expiring soon</li>
                                <li>Monthly report available for download</li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $("#category").change(function() {
            let kategori_id = $(this).val();

            $.ajax({
                url: "{{ route('filter.barang') }}", // Sesuaikan dengan route yang kamu buat
                type: "GET",
                data: {
                    kategori: kategori_id
                },
                success: function(response) {
                    let tableBody = $("#barang-table-body");
                    tableBody.empty(); // Kosongkan tabel sebelum menambahkan data baru

                    if (response.barangs.length > 0) {
                        $.each(response.barangs, function(index, barang) {
                            let row = `<tr>
                                        <td class="px-6 py-4 whitespace-nowrap">${index + 1}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black">${barang.nama}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <!-- Tambahkan aksi di sini -->
                                        </td>
                                    </tr>`;
                            tableBody.append(row);
                        });
                    } else {
                        tableBody.append(
                            `<tr><td colspan="3" class="text-center px-6 py-4">Tidak ada barang</td></tr>`
                            );
                    }
                },
                error: function() {
                    alert("Gagal mengambil data barang.");
                }
            });
        });
    });
</script>
