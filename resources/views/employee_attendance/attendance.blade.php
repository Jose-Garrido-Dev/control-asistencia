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
                'name' => 'Reporte Asistencia',
                'url' => route('employee.attendance'),
                'active' => request()->routeIs('employee.attendance'),
                'icon' => 'fa-solid fa-newspaper',
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

        <div class="container mt-4" x-data="{ showSuccess: @if(session('success')) true @else false @endif, showError: @if(session('error')) true @else false @endif }">
            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div id="alert-3" x-show="showSuccess" x-cloak class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" @click="showSuccess = false" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                    </button>
                  </div>
            @endif
        
            <!-- Mensaje de error -->
            @if(session('error'))
            <div id="alert-2" x-show="showError" x-cloak class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button" @click="showError = false" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                  <span class="sr-only">Close</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                </button>
              </div>
                
            @endif

        </div>    

        <h1 class="font-semibold text-3xl mb-3">Registro de Asistencia</h1>

        @include('layouts.includes.employee.employeeAttendanceReport')

       
    </div>
</div>

  

        @stack('modals')

        @livewireScripts
    </body>
</html>
