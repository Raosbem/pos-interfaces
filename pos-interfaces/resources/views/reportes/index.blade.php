@extends('layouts.app')
@section('title', 'Reportes')

@section('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('layouts.sidebar')

    <main class="ml-44 flex-1 p-6">

        {{-- Header --}}
        <div class="mb-5">
            <h1 class="text-xl font-bold text-pos-dark mb-4">Reportes</h1>

            {{-- Tabs --}}
            <div class="flex gap-0 border-b border-gray-200">
                <button class="px-4 py-2.5 text-sm font-semibold text-pos-accent border-b-2 border-pos-accent">
                    Productos Más Vendidos
                </button>
                <button class="px-4 py-2.5 text-sm font-medium text-gray-400 hover:text-gray-600 border-b-2 border-transparent">
                    Ventas vs Gastos
                </button>
            </div>
        </div>

        {{-- Filtros --}}
        <div class="flex items-center gap-3 mb-6 flex-wrap">
            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-3 py-2">
                <span class="text-xs text-gray-400">Desde</span>
                <input type="date" value="2026-02-01"
                       class="text-sm text-gray-700 focus:outline-none border-none bg-transparent">
            </div>
            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-3 py-2">
                <span class="text-xs text-gray-400">Hasta</span>
                <input type="date" value="2026-02-20"
                       class="text-sm text-gray-700 focus:outline-none border-none bg-transparent">
            </div>
            <select class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none">
                <option>Todas las categorías</option>
                <option>Bebidas</option>
                <option>Botanas</option>
                <option>Panadería</option>
                <option>Lácteos</option>
                <option>Despensa</option>
            </select>
            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-3 py-2">
                <span class="text-xs text-gray-400">Top:</span>
                <input type="number" value="10" min="1" max="50"
                       class="w-10 text-sm text-gray-700 focus:outline-none border-none bg-transparent">
            </div>
            <button class="px-4 py-2 bg-pos-accent hover:bg-blue-600 text-white rounded-lg text-sm font-semibold transition-all">
                Generar
            </button>
            <button class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-lg text-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Exportar PDF
            </button>
        </div>

        {{-- Contenido principal --}}
        <div class="grid grid-cols-5 gap-4">

            {{-- Gráfica de barras horizontales --}}
            <div class="col-span-3 bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-pos-dark mb-4">Ranking</h2>
                <canvas id="rankingChart" height="280"></canvas>
            </div>

            {{-- Tabla detalle --}}
            <div class="col-span-2 bg-white rounded-xl border border-gray-100 p-5 shadow-sm">
                <h2 class="text-sm font-semibold text-pos-dark mb-4">Detalle</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="pb-2 text-left text-gray-400 font-medium w-5">#</th>
                                <th class="pb-2 text-left text-gray-400 font-medium">Producto</th>
                                <th class="pb-2 text-left text-gray-400 font-medium">Categoría</th>
                                <th class="pb-2 text-right text-gray-400 font-medium">Unidades</th>
                                <th class="pb-2 text-right text-gray-400 font-medium">Ingresos</th>
                                <th class="pb-2 text-right text-gray-400 font-medium">% Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php
                            $productos = [
                                [1, 'Coca-Cola 600ml',  'Bebidas',   450, '$8750', '15.2%'],
                                [2, 'Sabritas Original','Botanas',   380, '$6840', '12.8%'],
                                [3, 'Agua Ciel 1L',     'Bebidas',   350, '$4200', '11.8%'],
                                [4, 'Pan Bimbo',        'Panadería', 290, '$5800', '9.8%'],
                                [5, 'Leche Lala',       'Lácteos',   275, '$5500', '9.3%'],
                                [6, 'Galletas Marías',  'Panadería', 240, '$3360', '8.1%'],
                                [7, 'Yogurt Danone',    'Lácteos',   220, '$3300', '7.4%'],
                                [8, 'Aceite 1L',        'Despensa',  195, '$2925', '6.6%'],
                                [9, 'Frijoles 1kg',     'Despensa',  180, '$2700', '6.1%'],
                                [10,'Cereal Zucaritas', 'Despensa',  175, '$2975', '5.9%'],
                            ];
                            @endphp
                            @foreach($productos as $p)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-2 text-gray-400">{{ $p[0] }}</td>
                                <td class="py-2 font-medium text-gray-800">{{ $p[1] }}</td>
                                <td class="py-2 text-gray-400">{{ $p[2] }}</td>
                                <td class="py-2 text-right text-gray-700">{{ $p[3] }}</td>
                                <td class="py-2 text-right font-semibold text-pos-dark">{{ $p[4] }}</td>
                                <td class="py-2 text-right text-gray-400">{{ $p[5] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-gray-200">
                                <td colspan="3" class="pt-3 font-bold text-gray-700 text-xs">TOTAL</td>
                                <td class="pt-3 text-right font-bold text-gray-700">2755 uds</td>
                                <td class="pt-3 text-right font-bold text-pos-dark">$44,350</td>
                                <td class="pt-3 text-right font-bold text-gray-700">100%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
const ctx = document.getElementById('rankingChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Coca-Cola 600ml','Sabritas Original','Agua Ciel 1L','Pan Bimbo','Leche Lala','Galletas Marías','Yogurt Danone','Aceite 1L','Frijoles 1kg','Cereal Zucaritas'],
        datasets: [{
            data: [450, 380, 350, 290, 275, 240, 220, 195, 180, 175],
            backgroundColor: '#1a2942',
            borderRadius: 4,
            borderSkipped: false,
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: {
            x: {
                grid: { color: '#f3f4f6' },
                ticks: { font: { size: 10 }, color: '#9ca3af' }
            },
            y: {
                grid: { display: false },
                ticks: { font: { size: 10 }, color: '#374151' }
            }
        }
    }
});
</script>
@endsection