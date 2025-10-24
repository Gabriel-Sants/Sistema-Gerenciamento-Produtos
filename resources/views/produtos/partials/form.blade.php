<div class="rounded-2xl shadow-xl p-8 border border-gray-200">
    <h2 class="text-2xl font-bold mb-6">{{ $title }}</h2>

    <div id="mensagem" class="mb-4"></div>

    <form id="formProduto" action="{{ $action }}" method="POST" class="space-y-6">
        @csrf
        @if (isset($produto))
            @method('PUT')
        @else
            @method('POST')
        @endif

        <div>
            <label class="block font-semibold mb-1">Título:<span class="text-red-500">*</span></label>
            <input type="text" name="titulo" required
                class="border border-gray-300 rounded-md w-full p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="Digite o titulo do produto." value={{ $produto->titulo ?? '' }}>
        </div>

        <div>
            <label class="block font-semibold mb-1">Marca:</label>
            <input type="text" name="marca"
                class="border border-gray-300 rounded-md w-full p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="Digite a marca do produto." value={{ $produto->marca ?? '' }}>

        </div>

        <div>
            <label class="block font-semibold mb-1">Preço:<span class="text-red-500">*</span></label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" required
                class="border border-gray-300 rounded-md w-full p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="R$ 0,00" value={{ $produto->preco ?? '' }}>

        </div>

        <div>
            <label class="block font-semibold mb-1">Quantidade:<span class="text-red-500">*</span></label>
            <input type="number" name="quantidade" min="1" required
                class="border border-gray-300 rounded-md w-full p-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="Digite a quantidade de produtos." value={{ $produto->quantidade ?? '' }}>

        </div>

        <div>
            <label class="block font-semibold mb-1">Conteudo:</label>
            <textarea name="conteudo" rows="4"
                class="border border-gray-300 rounded-md w-full p-3 resize-none focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="Descreva esse produto."> {{ $produto->conteudo ?? '' }}</textarea>

        </div>

        <div class="mb-4">
            <label class="block font-semibold font-big mb-2">Status <span class="text-red-500">*</span></label>
            <div class="flex items-center space-x-3">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" id="statusToggle" name="status" value="1" class="sr-only peer"
                        {{ old('status', $produto->status ?? 1) == 1 ? 'checked' : '' }}>
                    <div
                        class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-green-500 
                        after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                        after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full">
                    </div>
                </label>
                <span id="statusLabel" class="text-sm">
                    {{ old('status', $produto->status ?? 1) == 1 ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
        </div>

        {{-- <div>
            <label class="block font-semibold mb-2">Categorias:</label>
            <div id="categoriasContainer" class="flex flex-wrap gap-2">
                @foreach ($categorias as $categoria)
                    <button type="button"
                        class="tagCategoria border border-gray-300 px-3 py-1 rounded-full hover:bg-red-500 hover:text-white transition"
                        data-id="{{ $categoria->id }}">
                        {{ $categoria->nome }}
                    </button>
                @endforeach
            </div>

        </div> --}}

        <div class="flex gap-4 pt-4 border-t border-gray-200">
            <button type="submit"
                class="bg-primary hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition">
                Salvar Produto
            </button>

            <button type="button" onclick="document.getElementById('formularioProduto').innerHTML=''"
                class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded-md shadow-md transition">
                Cancelar
            </button>
        </div>
    </form>
</div>
