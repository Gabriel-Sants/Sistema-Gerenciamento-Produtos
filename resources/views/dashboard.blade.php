<x-layouts.app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- <div class="grid auto-rows-min gap-4 md:grid-cols-4"> --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">

            <x-dashboard-card title="Produtos" class="card-link bg-primary" count="{{ $totalProdutos ?? 0 }}"
                icon="fa-solid fa-boxes-stacked text-orange-300 text-4xl mb-2" link="{{ route('produtos.index') }}" />

            {{-- <x-dashboard-card title="Categorias" class="card-link bg-primary" count="{{ $totalCategorias ?? 0 }}"
                icon="fa-solid fa-tag text-yellow-400 text-4xl mb-2" link="{{ route('categorias.index') }}" /> --}}

            <x-dashboard-card title="Usuários" class="card-link bg-primary" count="{{ $totalUsers ?? 0 }}"
                icon="fa-solid fa-users text-black text-4xl mb-2" link="{{ route('users.index') }}" />

            {{-- <x-dashboard-card title="Relatórios" count="—" icon="📊" link="#" /> --}}

        </div>

        <x-dashboard-content />
    </div>

</x-layouts.app>
