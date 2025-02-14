<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Types d'Événements
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Types d'Événements</h3>
                <a href="{{ route('types.create') }}" class="px-4 py-2 bg-green-500 text-white rounded">
                    + Ajouter un Type
                </a>
            </div>

            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nom</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td class="border px-4 py-2">{{ $type->name }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('types.edit', $type) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Modifier</a>
                                <form action="{{ route('types.destroy', $type) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
