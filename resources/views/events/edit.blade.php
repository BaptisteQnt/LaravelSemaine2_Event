<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'Événement
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form method="POST" action="{{ route('events.update', $event->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Titre</label>
                    <input type="text" name="title" value="{{ $event->title }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2">{{ $event->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Nombre de places</label>
                    <input type="number" name="places" value="{{ $event->places }}" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Lieu</label>
                    <input type="text" name="location" value="{{ $event->location }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Dates existantes -->
                <div class="mb-4">
                    <label class="block text-gray-700">Dates</label>
                    <div id="dates-container">
                        @foreach ($event->dates as $date)
                            <input type="datetime-local" name="dates[]" value="{{ $date->date }}" class="w-full border rounded px-3 py-2 mt-2">
                        @endforeach
                    </div>
                    <button type="button" id="add-date" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">+ Ajouter une date</button>
                </div>

                <!-- Mots-clés -->
                <div class="mb-4">
                    <label class="block text-gray-700">Mots-clés</label>
                    <select name="keywords[]" multiple class="w-full border rounded px-3 py-2">
                        @foreach ($event->keywords as $keyword)
                            <option value="{{ $keyword->keyword_id }}" {{ in_array($keyword->id, $selectedKeywords) ? 'selected' : '' }}>
                                {{ $keyword->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Type d’événement :</label>
                    <select name="types[]" multiple class="w-full border rounded px-3 py-2">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ in_array($type->id, $selectedTypes) ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Modifier</button>
            </form>
        </div>
    </div>

</x-app-layout>
