@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('layouts.sidebar')

    <main class="ml-44 flex-1 p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-pos-dark">Dashboard Ejecutivo</h1>
            <div class="flex gap-1 bg-white border border-gray-200 rounded-lg p-1">
                @foreach(['Hoy', 'Semana', 'Mes', 'Año'] as $periodo)
                <button class="px-3 py-1.5 rounded-md text-sm font-medium transition-all
                    {{ $periodo === 'Hoy' ? 'bg-pos-dark text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                    {{ $periodo }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- KPI Cards --}}
        <div class="grid grid-cols-5 gap-4 mb-6">
            @php
            $kpis = [
                ['label' => 'Ventas Hoy', 'value' => '$20,580.00', 'sub' => '+12.5%', 'subColor' => 'text-green-500', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'iconBg' => 'bg-green-50', 'iconColor' => 'text-green-500'],
                ['label' => 'Transacciones', 'value' => '45', 'sub' => 'vs 38 ayer', 'subColor' => 'text-gray-400', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'iconBg' => 'bg-blue-50', 'iconColor' => 'text-blue-500'],
                ['label' => 'Ticket Promedio', 'value' => '$457.33', 'sub' => '', 'subColor' => '', 'icon' => 'M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z', 'iconBg' => 'bg-gray-50', 'iconColor' => 'text-gray-500'],
                ['label' => 'Utilidad Bruta', 'value' => '$7,250.00', 'sub' => '34.8%', 'subColor' => 'text-green-500', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'iconBg' => 'bg-green-50', 'iconColor' => 'text-green-500'],
                ['label' => 'Alertas Stock', 'value' => '12', 'sub' => '', 'subColor' => '', 'isAlert' => true, 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'iconBg' => 'bg-red-50', 'iconColor' => 'text-red-500'],
            ];
            @endphp

            @foreach($kpis as $kpi)
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 {{ $kpi['iconBg'] }} rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 {{ $kpi['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $kpi['icon'] }}"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-1">{{ $kpi['label'] }}</p>
                <p class="text-xl font-bold {{ isset($kpi['isAlert']) ? 'text-red-500' : 'text-pos-dark' }}">{{ $kpi['value'] }}</p>
                @if($kpi['sub'])
                    <p class="text-xs {{ $kpi['subColor'] }} mt-0.5">{{ $kpi['sub'] }}</p>
                @endif
                @if(isset($kpi['isAlert']))
                    <div class="mt-1 h-0.5 w-8 bg-red-400 rounded"></div>
                @endif
            </div>
            @endforeach
        </div>

        {{-- Charts row --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            {{-- Bar chart --}}
            <div class="col-span-2 bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-pos-dark mb-4">Ventas de la Semana</h2>
                <canvas id="ventasChart" height="100"></canvas>
            </div>

            {{-- Donut chart --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-pos-dark mb-4">Métodos de Pago</h2>
                <div class="flex items-center justify-center mb-3">
                    <canvas id="pagoChart" width="140" height="140"></canvas>
                </div>
                <p class="text-center text-xl font-bold text-pos-dark">$20,580</p>
                <p class="text-center text-xs text-gray-400 mb-3">Total</p>
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400 inline-block"></span>
                            <span class="text-gray-500">Efectivo</span>
                        </div>
                        <span class="font-medium text-gray-700">$12,350</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-pos-accent inline-block"></span>
                            <span class="text-gray-500">Tarjeta</span>
                        </div>
                        <span class="font-medium text-gray-700">$8,230</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom row --}}
        <div class="grid grid-cols-2 gap-4">
            {{-- Top productos --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-pos-dark mb-4">Top 5 Productos Hoy</h2>
                @php
                $productos = [
                    ['name' => 'Coca-Cola 600ml', 'uds' => 45, 'total' => '$675.00', 'pct' => 100],
                    ['name' => 'Sabritas Original', 'uds' => 38, 'total' => '$684.00', 'pct' => 84],
                    ['name' => 'Agua Ciel 1L', 'uds' => 35, 'total' => '$420.00', 'pct' => 77],
                    ['name' => 'Pan Bimbo', 'uds' => 29, 'total' => '$1,392.00', 'pct' => 64],
                    ['name' => 'Leche Lala', 'uds' => 27, 'total' => '$769.50', 'pct' => 60],
                ];
                @endphp
                <div class="space-y-3">
                    @foreach($productos as $i => $prod)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-600">{{ $i+1 }}. {{ $prod['name'] }}
                                <span class="text-gray-400">{{ $prod['uds'] }} uds</span>
                            </span>
                            <span class="text-xs font-semibold text-pos-dark">{{ $prod['total'] }}</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full">
                            <div class="h-1.5 rounded-full bg-pos-dark" style="width: {{ $prod['pct'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="#" class="mt-4 inline-block text-xs text-pos-accent hover:underline font-medium">Ver reporte completo →</a>
            </div>

            {{-- Cierres de caja --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-pos-dark mb-4">Cierres de Caja Hoy</h2>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="w-9 h-9 rounded-full bg-pos-dark flex items-center justify-center text-white text-xs font-bold flex-shrink-0">JP</div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="text-sm font-medium text-gray-800">Juan Perez</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Pendiente</span>
                            </div>
                            <p class="text-xs text-gray-400">Turno 08:00–16:00</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="w-9 h-9 rounded-full bg-teal-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">AT</div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="text-sm font-medium text-gray-800">Ana Torres</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Cerrado</span>
                            </div>
                            <p class="text-xs text-green-600 font-medium">Diferencia: +$20</p>
                            <p class="text-xs text-gray-400">06:00–14:00</p>
                        </div>
                    </div>
                </div>
                <a href="#" class="mt-4 inline-block text-xs text-pos-accent hover:underline font-medium">Ver todos los cierres →</a>
            </div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
// Bar chart
const ctx1 = document.getElementById('ventasChart').getContext('2d');
new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
        datasets: [{
            data: [16000, 14000, 17000, 15500, 20580, 0, 0],
            backgroundColor: ['#1e3a5f','#1e3a5f','#1e3a5f','#1e3a5f','#1a2942','#e5e7eb','#e5e7eb'],
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: { grid: { color: '#f3f4f6' }, ticks: { font: { size: 10 }, color: '#9ca3af', callback: v => '$'+v/1000+'k' } },
            x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#6b7280' } }
        }
    }
});

// Donut chart
const ctx2 = document.getElementById('pagoChart').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [12350, 8230],
            backgroundColor: ['#4ade80', '#3b82f6'],
            borderWidth: 0,
            cutout: '72%',
        }]
    },
    options: { plugins: { legend: { display: false } } }
});
</script>
@endsection