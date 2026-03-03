@extends('layouts.app')
@section('title', 'Punto de Venta')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('layouts.sidebar')

    <main class="ml-44 flex-1 p-6 flex items-center justify-center gap-8">

        {{-- Modal INT-10: Cobro en Efectivo --}}
        <div class="bg-white rounded-2xl shadow-xl w-80 overflow-hidden border border-gray-100">
            {{-- Header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800">Cobro en Efectivo</span>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="px-5 py-5">
                {{-- Total --}}
                <div class="text-center mb-5">
                    <p class="text-3xl font-bold text-pos-dark mono">$235.48</p>
                </div>

                {{-- Monto recibido --}}
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Monto Recibido</label>
                    <div class="flex items-center border-2 border-green-400 rounded-xl overflow-hidden">
                        <span class="px-3 text-gray-400 font-medium text-sm">$</span>
                        <input type="number" value="300.00"
                               class="flex-1 py-3 pr-3 text-xl font-bold text-pos-dark mono focus:outline-none">
                    </div>
                </div>

                {{-- Botones rápidos --}}
                <div class="grid grid-cols-3 gap-2 mb-5">
                    @foreach(['$100', '$200', '$300', '$500', '$1000'] as $i => $monto)
                    <button class="py-2.5 rounded-xl text-sm font-semibold border transition-all
                        {{ $monto === '$300'
                            ? 'bg-green-500 text-white border-green-500'
                            : 'bg-white text-gray-700 border-gray-200 hover:border-gray-400' }}
                        {{ $i >= 3 ? 'col-span-' . ($i === 4 ? '2' : '1') : '' }}">
                        {{ $monto }}
                    </button>
                    @endforeach
                </div>

                {{-- Cambio --}}
                <div class="bg-green-50 rounded-xl p-4 text-center mb-5">
                    <p class="text-xs text-gray-500 mb-1">Cambio a entregar:</p>
                    <p class="text-2xl font-bold text-green-600 mono">$64.52</p>
                </div>

                {{-- Acciones --}}
                <div class="grid grid-cols-2 gap-3">
                    <button class="py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all">
                        Cancelar
                    </button>
                    <button class="py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white text-sm font-semibold transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Confirmar Cobro
                    </button>
                </div>
            </div>
        </div>

        {{-- Modal INT-11: Cobro con Tarjeta --}}
        <div class="bg-white rounded-2xl shadow-xl w-80 overflow-hidden border border-gray-100">
            {{-- Header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800">Cobro con Tarjeta</span>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="px-5 py-5">
                {{-- Total --}}
                <div class="text-center mb-5">
                    <p class="text-3xl font-bold text-pos-dark mono">$235.48</p>
                </div>

                {{-- Tarjeta ilustración --}}
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 bg-pos-accent rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-center text-sm text-gray-400 mb-5">Pase la tarjeta por la terminal</p>

                {{-- Referencia --}}
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">
                        No. Referencia / Autorización <span class="text-red-500">*</span>
                    </label>
                    <input type="text" placeholder="Ingrese número de referencia"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm
                                  focus:outline-none focus:ring-2 focus:ring-pos-accent/30 focus:border-pos-accent
                                  placeholder-gray-300 transition-all">
                </div>

                {{-- Tipo de tarjeta --}}
                <div class="mb-5">
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Tipo de Tarjeta</label>
                    <select class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-pos-accent/30 focus:border-pos-accent
                                   text-gray-700 transition-all appearance-none bg-white">
                        <option>Débito</option>
                        <option>Crédito</option>
                    </select>
                </div>

                {{-- Acciones --}}
                <div class="grid grid-cols-2 gap-3">
                    <button class="py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all">
                        Cancelar
                    </button>
                    <button disabled
                            class="py-2.5 rounded-xl bg-gray-200 text-gray-400 text-sm font-semibold cursor-not-allowed transition-all">
                        Confirmar Pago
                    </button>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection