<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Usuários</h1>
    </div>

    <x-table :headers="['ID', 'Nome', 'E-mail']" title="Lista de Usuários" :exibirTotal="true" :qtdTotal="$qtdTotal" entidade="Usuários">

        @foreach ($users as $user)
            <tr>
                <td class="px-6 py-3 border border-gray-700">{{ $user->id }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $user->name }}</td>
                <td class="px-6 py-3 border border-gray-700">{{ $user->email ?? '-' }}</td>
            </tr>
        @endforeach
    </x-table>




</div>
