@props(['supplier'])

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Supplier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/supplier.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<!-- resources/views/permissions/index.blade.php -->


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
                    Manajemen Supplier
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

                        <li>
                            <a class="text-gray-700 pb-2" href="{{ route('supplier.index') }}">
                                List Supplier
                            </a>
                        </li>
                        <li>
                            <p class="text-red-600 border-b-2 border-red-600 pb-2" href="#">
                                Add Supplier
                            </p>
                        </li>
                        <li>
                            <a class="text-gray-700 pb-2 cursor-default" href="#">
                                Edit Supplier
                            </a>
                        </li>
                    </ul>
                </nav>
                <section>
                    <x-forms.form-supplier></x-forms.form-supplier>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
