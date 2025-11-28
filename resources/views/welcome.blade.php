<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cayena Control</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
<body class="flex flex-col items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat relative" 
        style="background-image: url('{{ asset('imagenes/imagen1.png') }}');">

    <!-- Capa semitransparente sobre la imagen -->
    <div class="absolute inset-0 bg-white/30"></div>
        
    <!-- Logo -->
    <div class="mb-8 animate-fadeIn">
        <!-- Reemplaza 'logo.png' con tu logo real -->
        <img src="{{ asset('imagenes') }}" alt="La Cayena Control Logo" class="w-32 h-32 object-contain">
    </div>

    <!-- Título principal -->
    <h1 class="text-6xl font-extrabold text-black mb-4 drop-shadow-lg text-center animate-fadeIn">La Cayena Control</h1>

    <!-- Subtítulo -->
    <p class="text-xl text-black/90 mb-10 text-center animate-fadeIn">Gestiona accesos y controla entradas y salidas de manera segura</p>

    <!-- Botón de acceso -->
    <a href="{{ route('login') }}" 
        class="bg-gradient-to-r from-blue-500 to-green-600 hover:from-green-600 hover:to-blue-700 text-white px-12 py-4 rounded-3xl shadow-2xl text-2xl font-semibold transition-transform transform hover:scale-105 hover:shadow-3xl animate-fadeIn">
        🔑 Acceder
    </a>

    <!-- Animaciones con Tailwind -->
    <style>
        @layer utilities {
            .animate-fadeIn {
                @apply opacity-0 animate-[fadeIn_1s_ease-out_forwards];
            }
            @keyframes fadeIn {
                0% { opacity: 0; transform: translateY(-20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        }
    </style>
</body>
</html>