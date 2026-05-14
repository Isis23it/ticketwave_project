<style>
    * {
        font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
    }
</style>

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#051F20] to-[#041617] text-white py-10">
        <div class="max-w-6xl mx-auto px-6">

            <h1 class="text-[42px] font-semibold tracking-tight mb-8">
                Mis boletos
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-[#112A2B] rounded-2xl p-7 border border-[#1d3c3d] shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                    <p class="text-white text-[32px] font-light tracking-tight">Boletos activos</p>
                    <p class="text-[#CDE4D2] text-[40px] font-light mt-2">{{ $boletosActivos }}</p>
                </div>

                <div class="bg-[#112A2B] rounded-2xl p-7 border border-[#1d3c3d] shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                    <p class="text-white text-[32px] font-light tracking-tight">Total gastado</p>
                    <p class="text-[#CDE4D2] text-[40px] font-light mt-2">
                        ${{ number_format($totalGastado, 2) }}
                    </p>
                    <p class="text-[#88B096] text-lg font-light tracking-[2px] mt-1">historial completo</p>
                </div>
            </div>

            <section class="bg-[#112A2B] rounded-2xl p-7 border border-[#1d3c3d] mb-8 shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <h2 class="text-[34px] font-light tracking-tight mb-6">Próximos eventos</h2>

                @php
                    $proximos = $pedidos
                        ->where('estado', '!=', 'cancelled')
                        ->flatMap->items
                        ->filter(fn($item) => optional($item->tipoEntrada->evento)->fecha_evento >= now())
                        ->take(1);
                @endphp

                @forelse ($proximos as $item)
                    <div class="flex items-center justify-between bg-[#0b292a] border border-[#1d3c3d] rounded-2xl p-5">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 bg-[#1e5a4b] rounded-xl flex items-center justify-center text-[42px] text-purple-400">
                                ♫
                            </div>

                            <div>
                                <p class="font-semibold tracking-tight text-white text-lg">
                                    {{ $item->tipoEntrada->evento->nombre ?? 'Evento no disponible' }}
                                </p>
                                <p class="text-[#CDE4D2] font-semibold">
                                    {{ $item->tipoEntrada->nombre ?? 'Entrada' }}
                                </p>
                                <p class="text-sm text-[#88B096] font-semibold">
                                    {{ optional($item->tipoEntrada->evento->fecha_evento)->format('d/m/Y H:i') }}
                                    · {{ $item->tipoEntrada->evento->recinto->nombre ?? 'Recinto no disponible' }}
                                </p>
                            </div>
                        </div>

                        <span class="bg-[#628474] text-white px-12 py-2 rounded-lg font-semibold tracking-[1px] text-sm">
                            PROXIMO
                        </span>
                    </div>

                    <a href="#historial" class="block text-center mt-5 text-white font-semibold">
                        Ver más
                        <span class="block text-2xl leading-5">⌄</span>
                    </a>
                @empty
                    <p class="text-[#88B096] font-light">No tienes próximos eventos.</p>
                @endforelse
            </section>

            <section id="historial" class="bg-[#112A2B] rounded-2xl p-7 border border-[#1d3c3d] shadow-[0_0_20px_rgba(0,0,0,0.25)]">
                <h2 class="text-[34px] font-light tracking-tight mb-6">
                    Historial de compras
                </h2>

                <div class="flex gap-4 mb-6">
                    <button class="px-12 py-3 rounded-lg border border-[#628474] bg-[#628474] text-white font-light">
                        Todos
                    </button>
                    <button class="px-12 py-3 rounded-lg border border-[#628474] text-white font-light">
                        Próximos
                    </button>
                    <button class="px-12 py-3 rounded-lg border border-[#628474] text-white font-light">
                        Usados
                    </button>
                </div>

                @forelse ($pedidos as $pedido)
                    @foreach ($pedido->items as $item)
                        @php
                            $evento = $item->tipoEntrada->evento ?? null;
                            $fechaEvento = $evento?->fecha_evento;
                            $esCancelado = $pedido->estado === 'cancelled';
                            $esUsado = !$esCancelado && $fechaEvento && $fechaEvento->isPast();
                            $estadoVisual = $esCancelado ? 'CANCELADO' : ($esUsado ? 'USADO' : 'PROXIMO');
                        @endphp

                        <details class="group mb-4 bg-[#0b292a] border border-[#1d3c3d] rounded-2xl p-5 {{ $esCancelado ? 'border-l-4 border-l-red-600' : '' }}">
                            <summary class="cursor-pointer list-none flex items-center justify-between">
                                <div class="flex items-center gap-6 {{ $esCancelado ? 'opacity-60 line-through' : '' }}">
                                    <div class="w-20 h-20 bg-[#1e5a4b] rounded-xl flex items-center justify-center text-[42px] text-purple-400">
                                        ♫
                                    </div>

                                    <div>
                                        <p class="font-semibold tracking-tight text-white text-lg">
                                            {{ $evento->nombre ?? 'Evento no disponible' }}
                                        </p>
                                        <p class="text-[#CDE4D2] font-semibold">
                                            {{ $item->tipoEntrada->nombre ?? 'Tipo de entrada no disponible' }}
                                        </p>
                                        <p class="text-sm text-[#88B096] font-semibold">
                                            {{ $fechaEvento ? $fechaEvento->format('d/m/Y H:i') : 'Fecha no disponible' }}
                                            · {{ $evento->recinto->nombre ?? 'Recinto no disponible' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-5">
                                    <span class="px-10 py-2 rounded-lg text-sm font-semibold tracking-[1px] text-white
                                        {{ $esCancelado ? 'bg-red-700' : 'bg-[#628474]' }}">
                                        {{ $estadoVisual }}
                                    </span>

                                    <span class="text-[#CDE4D2] text-2xl group-open:rotate-180 transition">
                                        ⌄
                                    </span>
                                </div>
                            </summary>

                            <div class="mt-5 pt-5 border-t border-[#1d3c3d] text-[#CDE4D2] font-light">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <p><strong class="text-white font-semibold">Pedido:</strong> #{{ $pedido->id }}</p>
                                    <p><strong class="text-white font-semibold">Fecha de compra:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong class="text-white font-semibold">Cantidad:</strong> {{ $item->cantidad }}</p>
                                    <p><strong class="text-white font-semibold">Precio unitario:</strong> ${{ number_format($item->precio_unitario, 2) }}</p>
                                    <p><strong class="text-white font-semibold">Total pedido:</strong> ${{ number_format($pedido->monto_total, 2) }}</p>
                                    <p><strong class="text-white font-semibold">Estado del pago:</strong> {{ $pedido->pago->estado ?? 'Sin pago registrado' }}</p>
                                    <p><strong class="text-white font-semibold">Método de pago:</strong> {{ $pedido->pago->metodo_pago ?? 'No registrado' }}</p>
                                    <p><strong class="text-white font-semibold">ID transacción:</strong> {{ $pedido->pago->id_transaccion ?? 'No registrado' }}</p>
                                </div>
                            </div>
                        </details>
                    @endforeach
                @empty
                    <div class="text-center py-24">
                        <p class="text-xl mb-6 text-white font-light">
                            Aún no has comprado boletos.
                        </p>

                        <a href="/" class="inline-block bg-[#CDE4D2] text-[#051F20] px-8 py-3 rounded-lg font-semibold">
                            Ver eventos
                        </a>
                    </div>
                @endforelse
            </section>
        </div>
    </div>
</x-app-layout>