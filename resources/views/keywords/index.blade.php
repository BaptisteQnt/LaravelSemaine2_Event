<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Mots-Clés
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Mots-Clés disponibles</h3>
                <a href="{{ route('keywords.create') }}" class="px-4 py-2 bg-green-500 text-white rounded">
                    + Ajouter un Mot-Clé
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
                    @foreach ($keywords as $keyword)
                        <tr>
                            <td class="border px-4 py-2">{{ $keyword->name }}</td>
                            <td class="border px-4 py-2">
                                <form action="#" method="POST" class="inline-block">
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
