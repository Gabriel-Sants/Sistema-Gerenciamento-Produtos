<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Categorias</h1>

        <button type="button" id="btnNovaCategoria" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-red-700">
            + Nova Categoria
        </button>
    </div>


    <x-table :headers="['ID', 'Nome', 'Descrição', 'Quantidade de Produtos', 'Status', 'Ações']" title="Lista de Categorias" :exibirTotal="true" :qtdTotal="$qtdTotal" entidade='Categorias'>
        @foreach ($categorias as $categoria)
            <tr>
                <td class="px-6 py-3 border border-gray-700">{{ $categoria->id }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $categoria->nome }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $categoria->descricao }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $categoria->produtos_count }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $categoria->status }}</td>

                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">

                        <button type="button"
                            class="btnEditarCategoria bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-150"
                            data-id="{{ $categoria->id }}">
                            Editar
                        </button>

                        <form method="POST" action="{{ route('categorias.destroy', $categoria) }}"
                            class="form-excluir-categoria" data-id="{{ $categoria->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-150">
                                Excluir
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-table>


    <div id="formulariocategoria" class="mt-6"></div>

</div>
