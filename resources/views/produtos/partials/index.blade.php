<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Produtos</h1>

        {{-- Quando a view for retornada de forma dinâmica (via Ajax). --}}
        @if ($requisicaoAjax)
            <button type="button" id="btnNovoProduto" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-red-700">
                + Novo Produto
            </button>

            @else{{-- Quando a view for retornada de forma estática. --}}
            <a href="{{ route('produtos.create') }}"
                class="bg-primary text-white px-4 py-2 rounded-md hover:bg-red-700 inline-block">
                + Novo Produto
            </a>
        @endif
        
        <div class="flex justify-end mb-4">
            <a href="{{ route('produtos.pdf') }}" target="_blank"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                🧾 Exportar PDF
            </a>
        </div>
      
    </div>

    <x-table :headers="[
        'ID',
        'Título',
        'Marca',
        // 'Categorias',
        'Quantidade',
        'Valor Unitário',
        'Valor Total',
        'Status',
        'Ações',
    ]" title="Lista de Produtos" :exibirTotal="true" :exibirValor="true" :valorTotal="$valorTotal"
        :qtdTotal="$qtdTotal" entidade='Produtos'>

        @foreach ($produtos as $produto)
            @php
                $valorTotalItem = $produto->quantidade * $produto->preco;
            @endphp
            <tr>
                <td class="px-6 py-3 border border-gray-700">{{ $produto->id }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $produto->titulo }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $produto->marca ?? '-' }}</td>

                {{-- <td class="px-6 py-3 border border-gray-700">
                    @foreach ($produto->categorias as $categoria)
                        <span class="bg-gray-700 text-white text-xs px-2 py-1 rounded">{{ $categoria->nome }}</span>
                    @endforeach
                </td> --}}

                <td class="px-6 py-3 border border-gray-700">{{ $produto->quantidade }}</td>
                <td class="px-6 py-3 border border-gray-700">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td class="px-6 py-3 border border-gray-700">R$ {{ number_format($valorTotalItem, 2, ',', '.') }}</td>

                <td class="px-6 py-3 border border-gray-700">
                    @if ($produto->status)
                        <span class="px-2 py-1 text-green-700 bg-green-100 rounded-full text-sm">Ativo</span>
                    @else
                        <span class="px-2 py-1 text-gray-700 bg-red-200 rounded-full text-sm">Inativo</span>
                    @endif
                </td>

                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">


                        @if ($requisicaoAjax)
                            <button type="button"
                                class="btnEditarProduto bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-150"
                                data-id="{{ $produto->id }}">
                                Editar
                            </button>

                            <form method="POST" action="{{ route('produtos.destroy', $produto) }}"
                                class="form-excluir-produto" data-id="{{ $produto->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-150">
                                    Excluir
                                </button>
                            </form>
                        @else
                            <a href="{{ route('produtos.edit', $produto) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-150 inline-block">
                                Editar
                            </a>

                            <form method="POST" action="{{ route('produtos.destroy', $produto) }}"
                                class="form-excluir-produto" data-id="{{ $produto->id }}"
                                onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-150">
                                    Excluir
                                </button>
                            </form>
                        @endif
                    </div>
                </td>

            </tr>
        @endforeach
    </x-table>


    <div id="formularioProduto" class="mt-6"></div>

</div>
