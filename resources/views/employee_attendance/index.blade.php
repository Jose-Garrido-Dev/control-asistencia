<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
      <!-- Fonts awesome -->
        <script src="https://kit.fontawesome.com/eb3cc9634f.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased" x-data="{open:true}">

        
        @include('layouts.includes.employee.nav')
          
        @php
        $links = [
            [
                'name' => 'Dashboard',
                'url' => route('employee.dashboard'),
                'active' => request()->routeIs('employee.dashboard'),
                'icon' => 'fa-solid fa-gauge-high',
                //'can' => ['Acceso al dashboard']
            ],
            [
                'name' => 'Cerrar Sesión',
                'url' => '#',
                'active' => false,
                'icon' => 'fa-solid fa-sign-out-alt',
                'id' => 'logout-link',
                'onclick' => "event.preventDefault(); document.getElementById('logout-form').submit();",
                //'can' => ['Gestion de permisos']
    ],
        ];
        @endphp
        
        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            :class="{
                '-translate-x-full': !open,
                'transform-none': open,
            }"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    @foreach ($links as $link)
                        @if ($link['name'] === 'Cerrar Sesión')
                            <li>
                                <a href="{{ $link['url'] }}" id="{{ $link['id'] }}" onclick="{{ $link['onclick'] }}"
                                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <i class="{{ $link['icon'] }} text-gray-500"></i>
                                    <span class="ml-3">{{ $link['name'] }}</span>
                                </a>
                            </li>
                        @else
                            @canany($link['can'] ?? [null])
                                <li>
                                    <a href="{{ $link['url'] }}"
                                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                                        <i class="{{ $link['icon'] }} text-gray-500"></i>
                                        <span class="ml-3">{{ $link['name'] }}</span>
                                    </a>
                                </li>
                            @endcanany
                        @endif
                    @endforeach
                </ul>
            </div>
        </aside>
        

  
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <h1 class="font-semibold tex-2xl mb-3">Registro de Asistencia</h1>

        @if (session('employee'))
            <h1 class="font-bold text-3xl">Hola, {{ session('firstName') }} {{ session('lastName') }}</h1>
            <!--<p>Employee ID: {{ session('employee')->employee_id }}</p>-->
            @include('layouts.includes.employee.dashboard')
    
            <!-- Botón para cerrar sesión -->
            <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <p>No se encontró información del empleado en la sesión.</p>
        @endif
    </div>
</div>

  

        @stack('modals')

        @livewireScripts
    </body>
</html>
