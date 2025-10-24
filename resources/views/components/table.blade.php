@props([
    'headers' => [],
    'title' => null,
    'exibirTotal' => false,
    'exibirValor' => false,
    'qtdTotal' => 0,
    'valorTotal' => 0,
    'entidade' => null,
])

<div class="overflow-x-auto rounded-xl shadow-lg border border-gray-700">

    <table class="min-w-full bg-gray-800 text-sm text-gray-200">
        <thead>
            @if ($title)
                <tr>
                    <th class="bg-gray-900 text-white text-center text-lg font-bold py-4 border-b border-gray-700"
                        colspan="{{ count($headers) }}">
                        {{ $title }}
                    </th>
                </tr>
            @endif

            <tr class="bg-gray-700 text-center">
                @foreach ($headers as $header)
                    <th class="px-6 py-3 border border-gray-600 font-semibold">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody class="text-center">
            {{ $slot }}
        </tbody>

        @if ($exibirTotal || $exibirValor)
            <tfoot>
                <tr class="bg-gray-700 font-bold text-center">
                    @if ($exibirTotal)
                        <td class="px-6 py-3 border border-gray-600 text-right" colspan="{{ $exibirValor ? count($headers) - 5 : count($headers) - 1  }}">

                            Total de {{ $entidade }}:
                        </td>
                        <td class="px-6 py-3 border border-gray-600">
                            {{ $qtdTotal }}
                        </td>
                    @endif

                    @if ($exibirValor)
                        <td class="px-6 py-3 border border-gray-600 text-right" colspan="{{  count($headers) - 5 }}">
                            Valor Total:
                        </td>
                        <td class="px-6 py-3 border border-gray-600">
                            R$ {{ number_format($valorTotal, 2, ',', '.') }}
                        </td>
                    @endif
                </tr>
            </tfoot>
        @endif
    </table>
</div>
