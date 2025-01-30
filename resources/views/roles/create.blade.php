<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    Manajemen Role
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
                <nav class="mb-6">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-red-600 border-b-2 border-red-600 pb-2" href="#">
                                Membuat Role
                            </a>
                        </li>
                        <li>
                            <a class="text-gray-700 pb-2" href="{{ route('roles.index') }}">
                                List Role
                            </a>
                        </li>
                        <li>
                            <p class="text-gray-700 pb-2 cursor-default" href="">
                                Edit Role
                            </p>
                        </li>

                    </ul>
                </nav>
                <section class="mb-6 pr-5 flex justify-center">
                    <form action="{{ route('roles.store') }}" method="POST" class="space-y-4 w-full max-w-3xl">
                        @csrf
                        <div>
                            <label for="roles" class="block text-sm font-medium text-gray-700">Nama Role</label>
                            <input type="text" id="buat-role" name="name" value="{{ old('name') }}"
                                placeholder="Role"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            @error('role')
                                <p class="text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-4">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" class="rounded"
                                            name="permission[]" value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach

                            @endif
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-red-500 text-white p-2 rounded-md hover:bg-red-600">Submit</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
