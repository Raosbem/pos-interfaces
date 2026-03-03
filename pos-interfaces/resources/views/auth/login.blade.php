@extends('layouts.app')
@section('title', 'Iniciar Sesión')

@section('content')
<div class="min-h-screen flex">

    {{-- Panel izquierdo --}}
    <div class="hidden lg:flex w-1/2 relative items-center justify-center"
         style="background: linear-gradient(145deg, #1a2942 0%, #1e3a5f 40%, #2d5282 100%);">

        {{-- Textura de fondo --}}
        <div class="absolute inset-0 opacity-10"
             style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>

        {{-- Blob decorativo --}}
        <div class="absolute top-20 right-10 w-64 h-64 rounded-full opacity-10"
             style="background: radial-gradient(circle, #3b82f6, transparent); filter: blur(40px);"></div>
        <div class="absolute bottom-20 left-10 w-48 h-48 rounded-full opacity-10"
             style="background: radial-gradient(circle, #60a5fa, transparent); filter: blur(30px);"></div>

        <div class="relative z-10 text-center px-12">
            {{-- Ícono --}}
            <div class="mx-auto mb-6 w-24 h-24 rounded-2xl flex items-center justify-center border-2 border-white/20"
                 style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px);">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1 class="text-white text-3xl font-bold tracking-tight mb-2">Sistema POS</h1>
            <p class="text-blue-200/70 text-base">Gestión de Ventas e Inventario</p>
        </div>
    </div>

    {{-- Panel derecho --}}
    <div class="flex-1 flex items-center justify-center px-8 py-12 bg-white">
        <div class="w-full max-w-sm">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-pos-dark mb-1">Iniciar Sesión</h2>
                <p class="text-gray-400 text-sm">Ingresa tus credenciales para continuar</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Correo Electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="correo@ejemplo.com"
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm
                                      focus:outline-none focus:ring-2 focus:ring-pos-accent/30 focus:border-pos-accent
                                      transition-all placeholder-gray-300
                                      @error('email') border-red-400 @enderror">
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" name="password" id="passwordInput" required
                               placeholder="••••••••"
                               class="w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm
                                      focus:outline-none focus:ring-2 focus:ring-pos-accent/30 focus:border-pos-accent
                                      transition-all placeholder-gray-300
                                      @error('password') border-red-400 @enderror">
                        <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded border-gray-300 text-pos-accent accent-pos-accent">
                        <span class="text-sm text-gray-600">Recordar sesión</span>
                    </label>
                    <a href="#" class="text-sm text-pos-accent hover:underline font-medium">¿Olvidaste tu contraseña?</a>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-2.5 bg-pos-dark text-white rounded-lg font-semibold text-sm
                               hover:bg-pos-mid transition-all duration-200 shadow-md hover:shadow-lg
                               active:scale-[0.98]">
                    Iniciar Sesión
                </button>

                <p class="text-center text-xs text-gray-400">
                    Sistema protegido. Acceso solo personal autorizado.
                </p>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection