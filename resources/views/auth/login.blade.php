<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center bg-gray-100 font-sans font-semibold">
    <div
        class="absolute top-0 left-0 w-[600px] h-[600px] bg-red-500 rounded-full -ml-72 -mt-72 z-0 border-[25px] border-red-700">
    </div>
    <div
        class="absolute bottom-0 right-0 w-60 h-60 bg-blue-500 rounded-full -mr-20 -mb-20 z-0 border-[20px] border-blue-900 translate-x-10 translate-y-12">
    </div>
    <div
        class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row overflow-hidden max-w-7xl w-full justify-center h-[90vh] flex-nowrap">
        <div class="md:w-1/2 p-8 relative flex flex-col justify-center bg-white">
            <div class="absolute top-0 left-0 w-40 h-40 bg-blue-900 rounded-full -ml-20 -mt-20">
            </div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-red-500 rounded-full -mr-20 -mb-20">
            </div>
            <div class="text-center mb-8 relative z-10">
                <h2 class="text-2xl font-bold text-gray-800">
                    WELCOME TO
                </h2>
                <h1 class="text-3xl font-bold text-red-500">
                    Procurement
                </h1>
                <p class="text-gray-500 mt-2">
                    Aplikasi Sistem Pengadaan Barang dan Jasa
                </p>
            </div>
            <form action="{{ route('login') }}" method="POST" class="relative z-10">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">
                        <i class="fas fa-user absolute mt-3 ml-3 text-gray-400">
                        </i>
                        <input name="email"
                            class="form-control pl-10 pr-4 py-3 rounded-lg w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') is-invalid @enderror"
                            placeholder="Email" type="email" />
                        @error('email')
                            <div class="invalid-feedback">Email is invalid</div>
                        @enderror
                    </label>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700">
                        <i class="fas fa-lock absolute mt-3 ml-3 text-gray-400">
                        </i>
                        <input name="password"
                            class="form-control pl-10 pr-4 py-3 rounded-lg w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') is-invalid @enderror"
                            placeholder="Password" type="password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </label>
                </div>

                <button
                    class="bg-gradient-to-r from-red-500 to-blue-950 text-white font-bold py-3 rounded-lg w-full shadow-lg hover:from-red-600 hover:to-blue-600">
                    SIGN IN
                </button>
            </form>
            <div
                class="text-center text-red-500 hover:text-transparent hover:bg-clip-text hover:bg-gradient-to-tl from-red-500 to-blue-950 mt-6 relative z-10">
                <a href="{{ route('register') }}">
                    Create an account
                </a>
            </div>
        </div>
        <div class="md:w-1/2 relative flex items-center justify-center">
            <img alt="Cityscape background" class="absolute inset-0 h-full w-full object-cover opacity-90"
                src="{{ asset('img/bg-login-page.jpeg') }}" />
            <div class="absolute inset-0 bg-blue-950 opacity-75">
            </div>

        </div>
    </div>
</body>

</html>
