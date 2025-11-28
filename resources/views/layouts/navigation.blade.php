<nav class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-sky-400 to-cyan-400 border-b border-sky-500 text-white shadow-lg">
    <!-- menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                <!-- navegación inicio -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                        class="bg-gradient-to-br from-indigo-300 to-indigo-400 hover:from-blue-500 hover:to-blue-600 text-white px-6 py-2 rounded-xl shadow-md text-center transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95 font-semibold"
                        style="box-shadow: 0 4px 0 rgba(165, 180, 252, 0.4);">
                        {{ __('Inicio') }}
                    </a>

                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-br from-rose-300 to-rose-400 hover:from-rose-400 hover:to-rose-500 text-white font-semibold px-4 py-2 rounded-xl shadow-md transition-all duration-300 transform hover:scale-105 hover:shadow-lg active:scale-95"
                        style="box-shadow: 0 4px 0 rgba(255, 196, 203, 0.4);">
                        {{ __('Perfil') }}
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-br from-cyan-300 to-cyan-400 hover:from-blue-500 hover:to-blue-600 shadow-md focus:outline-none transition-all duration-300 transform hover:scale-105"
                            style="box-shadow: 0 4px 0 rgba(103, 232, 249, 0.4);">
                            <div>{{ Auth::user()->name }}</div>

                            <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a 1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>

<!-- Espacio para que el contenido no quede debajo del menú fijo -->
<div class="pt-16"></div>