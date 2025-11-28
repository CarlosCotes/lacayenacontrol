<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - La Cayena Control</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-r from-white-900 via-blue-700 to-indigo-600 flex items-center justify-center">

    <div class="w-full max-w-md bg-white/90 backdrop-blur-md border border-blue-400 p-10 rounded-3xl shadow-2xl">
        <h1 class="text-4xl font-extrabold text-center text-blue-800 mb-2">La Cayena Control</h1>


        {{-- MENSAJE DE ERROR --}}
        @if(session('status'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center">
                {{ session('status') }}
            </div>
        @endif

        {{-- VALIDACIONES --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-6 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-gray-700 font-semibold text-sm mb-1">Correo electrónico</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold text-sm mb-1">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2 shadow focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-semibold py-3 rounded-2xl shadow-lg transition-transform transform hover:scale-105">
                Ingresar
            </button>
        </form>

</body>
</html>