
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <x-form-register :roles="$roles"></x-form-register>
        <div class="md:w-1/2 relative flex items-center justify-center">
            <img alt="Cityscape background" class="absolute inset-0 h-full w-full object-cover opacity-90"
                src="{{ asset('img/bg-login-page.jpeg') }}" />
            <div class="absolute inset-0 bg-blue-950 opacity-75">
            </div>

        </div>
    </div>

</body>

</html>
