@extends('layouts.app')
@section('title', 'Gestión de Usuarios')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('layouts.sidebar')

    <main class="ml-44 flex-1 p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-pos-dark">Gestión de Usuarios</h1>
            <button class="flex items-center gap-2 px-4 py-2 bg-pos-accent hover:bg-blue-600 text-white rounded-lg text-sm font-semibold transition-all shadow-sm shadow-blue-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Usuario
            </button>
        </div>

        {{-- Grid de usuarios --}}
        @php
        $usuarios = [
            ['initials' => 'CL', 'name' => 'Carlos Lopez',   'email' => 'carlos@minegocio.mx', 'rol' => 'Gerente',   'rolColor' => 'bg-blue-100 text-blue-700',   'activo' => true,  'ultimo' => '20/02/2026 14:30', 'avatarBg' => 'bg-pos-dark'],
            ['initials' => 'JP', 'name' => 'Juan Perez',     'email' => 'juan@minegocio.mx',   'rol' => 'Cajero',    'rolColor' => 'bg-green-100 text-green-700',  'activo' => true,  'ultimo' => '20/02/2026 15:45', 'avatarBg' => 'bg-pos-mid'],
            ['initials' => 'MG', 'name' => 'Maria García',   'email' => 'maria@minegocio.mx',  'rol' => 'Almacen',   'rolColor' => 'bg-amber-100 text-amber-700',  'activo' => true,  'ultimo' => '20/02/2026 13:20', 'avatarBg' => 'bg-amber-500'],
            ['initials' => 'AT', 'name' => 'Ana Torres',     'email' => 'ana@minegocio.mx',    'rol' => 'Cajero',    'rolColor' => 'bg-green-100 text-green-700',  'activo' => true,  'ultimo' => '20/02/2026 16:10', 'avatarBg' => 'bg-teal-500'],
            ['initials' => 'PS', 'name' => 'Pedro Sanchez',  'email' => 'pedro@minegocio.mx',  'rol' => 'Cajero',    'rolColor' => 'bg-green-100 text-green-700',  'activo' => false, 'ultimo' => '15/02/2026 18:00', 'avatarBg' => 'bg-purple-500'],
        ];
        @endphp

        <div class="grid grid-cols-3 gap-4">
            @foreach($usuarios as $user)
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow">
                {{-- Info usuario --}}
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-11 h-11 rounded-full {{ $user['avatarBg'] }} flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                        {{ $user['initials'] }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $user['name'] }}</p>
                        <p class="text-xs text-gray-400 mb-2">{{ $user['email'] }}</p>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user['rolColor'] }}">
                            {{ $user['rol'] }}
                        </span>
                    </div>
                </div>

                {{-- Estado --}}
                <div class="mb-1">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full {{ $user['activo'] ? 'bg-green-400' : 'bg-gray-300' }} inline-block"></span>
                        <span class="text-xs {{ $user['activo'] ? 'text-green-600' : 'text-gray-400' }} font-medium">
                            {{ $user['activo'] ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-0.5">Último acceso: {{ $user['ultimo'] }}</p>
                </div>

                {{-- Divider --}}
                <div class="my-3 border-t border-gray-100"></div>

                {{-- Acciones --}}
                <div class="grid grid-cols-3 gap-2">
                    {{-- Editar --}}
                    <button class="flex items-center justify-center py-2 rounded-lg border border-gray-200 text-gray-500 hover:border-pos-accent hover:text-pos-accent transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                    {{-- Toggle estado --}}
                    <button class="flex items-center justify-center py-2 rounded-lg border border-gray-200 text-gray-500 hover:border-amber-400 hover:text-amber-500 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </button>
                    {{-- Cambiar contraseña --}}
                    <button class="flex items-center justify-center py-2 rounded-lg border border-gray-200 text-gray-500 hover:border-gray-400 hover:text-gray-700 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach

            {{-- Card agregar usuario --}}
            <div class="bg-white rounded-xl border-2 border-dashed border-gray-200 p-5 flex flex-col items-center justify-center cursor-pointer hover:border-pos-accent hover:bg-blue-50/30 transition-all group">
                <div class="w-12 h-12 rounded-full bg-gray-100 group-hover:bg-pos-accent/10 flex items-center justify-center mb-2 transition-all">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-pos-accent transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-400 group-hover:text-pos-accent font-medium transition-colors">Agregar Usuario</span>
            </div>
        </div>

    </main>
</div>
@endsection