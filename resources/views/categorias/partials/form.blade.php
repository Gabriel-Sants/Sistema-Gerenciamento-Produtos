<div class="rounded-2xl shadow-xl p-8 border border-gray-200">
    <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>

    <div id="mensagem" class="mb-4"></div>

    <form id="formCategoria" action="{{ $action }}" method="POST" class="space-y-6">
        @csrf
        @if (isset($categoria))
            @method('PUT')
        @else
            @method('POST')
        @endif

        <div>
            <label class="block font-semibold mb-1">Nome:<span class="text-red-500">*</span></label>
            <input type="text" name="nome" required
                class="border border-gray-300 rounded-md w-full p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="Digite o nome da categoria." value={{ $categoria->titulo ?? '' }}>
        </div>

        <div>
            <label class="block font-semibold mb-1">Descrição:</label>
            <textarea name="descricao" rows="4"
                class="border border-gray-300 rounded-md w-full p-3 resize-none focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="Descreva essa categoria."> {{ $categoria->conteudo ?? '' }}</textarea>

        </div>

        <div class="mb-4">
            <label class="block font-semibold font-big mb-2">Status <span class="text-red-500">*</span></label>
            <div class="flex items-center space-x-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" id="statusToggle" name="status" value="1" class="sr-only peer"
                        {{ old('status', $categoria->status ?? 1) == 1 ? 'checked' : '' }}>
                    <div
                        class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 
                        after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                        after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                    </div>
                </label>
                <span id="statusLabel" class="text-sm">
                    {{ old('status', $categoria->status ?? 1) == 1 ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
        </div>

        <div class="flex gap-4 pt-4 border-t border-gray-200">
            <button type="submit"
                class="bg-primary hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition">
                Salvar Categoria
            </button>

            <button type="button" onclick="document.getElementById('formulariocategoria').innerHTML=''"
                class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-md shadow-md transition">
                Cancelar
            </button>
        </div>
    </form>
</div>
