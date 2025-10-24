<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Usuários</h1>
    </div>

    <div class="flex justify-end mb-4">
        <a href="{{ route('users.pdf') }}" target="_blank"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
            📄 Exportar PDF
        </a>
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
