<x-layouts.app :title="'Produtos'">
    <div class="mt-6 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow p-2 min-h-[300px] ">
        @include('partials.head')
        @include('produtos.partials.create')
    </div>
</x-layouts.app>
