<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le Type d'Événement
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form method="POST" action="{{ route('types.update', $type) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Nom du Type :</label>
                    <input type="text" name="name" value="{{ $type->name }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Modifier</button>
            </form>
        </div>
    </div>
</x-app-layout>
