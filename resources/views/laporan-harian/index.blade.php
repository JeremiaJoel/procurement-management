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
                    <ul class="flex space-x-6 text-xl">
                        Rekap Laporan Harian
                    </ul>
                </nav>
                <x-datepicker></x-datepicker>


                <div class="bg-gray-100 rounded p-4">
                    <h2 class="text-2xl mb-4">List Laporan</h2>

                    <!-- Classes Table -->
                    <div class="relative overflow-auto">
                        <div class="overflow-x-auto rounded-lg">
                            <table class="min-w-full bg-white border mb-20">
                                <thead>
                                    <tr class="bg-[#2B4DC994] text-center text-xs md:text-sm font-thin text-white">
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">ID</span>
                                        </th>
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">Class Name</span>
                                        </th>
                                        <th class="p-0">
                                            <span class="block py-2 px-3 border-r border-gray-300">Level</span>
                                        </th>
                                        <th class="p-4 text-xs md:text-sm">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b text-xs md:text-sm text-center text-gray-800">
                                        <td class="p-2 md:p-4">01</td>
                                        <td class="p-2 md:p-4">Class 1</td>
                                        <td class="p-2 md:p-4">Beginner</td>
                                        <td class="relative p-2 md:p-4 flex justify-center space-x-2">
                                            <button
                                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs md:text-sm">Edit</button>
                                            <button
                                                class="bg-red-500 text-white px-3 py-1 rounded-md text-xs md:text-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <tr class="border-b text-xs md:text-sm text-center text-gray-800">
                                        <td class="p-2 md:p-4">02</td>
                                        <td class="p-2 md:p-4">Class 2</td>
                                        <td class="p-2 md:p-4">Intermediate</td>
                                        <td class="relative p-2 md:p-4 flex justify-center space-x-2">
                                            <button
                                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs md:text-sm">Edit</button>
                                            <button
                                                class="bg-red-500 text-white px-3 py-1 rounded-md text-xs md:text-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <tr class="border-b text-xs md:text-sm text-center text-gray-800">
                                        <td class="p-2 md:p-4">03</td>
                                        <td class="p-2 md:p-4">Class 3</td>
                                        <td class="p-2 md:p-4">Advanced</td>
                                        <td class="relative p-2 md:p-4 flex justify-center space-x-2">
                                            <button
                                                class="bg-blue-500 text-white px-3 py-1 rounded-md text-xs md:text-sm">Edit</button>
                                            <button
                                                class="bg-red-500 text-white px-3 py-1 rounded-md text-xs md:text-sm">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
