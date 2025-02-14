<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de l'Événement
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h3 class="text-2xl font-bold">{{ $event->title }}</h3>
            <p class="text-gray-700 mt-2">{{ $event->description }}</p>

            <div class="mt-4">
                <p class="text-sm">📍 <strong>Lieu :</strong> {{ $event->location }}</p>
                <p class="text-sm">🎟 <strong>Places disponibles :</strong> {{ $event->places ?? 'Non spécifié' }}</p>
                <p class="text-sm">🧑‍💼 <strong>Créé par :</strong> {{ $event->creator->name }}</p>
            </div>

            <div class="mt-4">
                <p class="text-sm font-semibold">📅 Dates :</p>
                <ul class="text-sm text-gray-600">
                    @foreach ($event->dates as $date)
                        <li>📅 {{ \Carbon\Carbon::parse($date->date)->format('d/m/Y H:i') }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-4">
                <p class="text-sm font-semibold">🏷️ Mots-clés :</p>
                <div class="flex gap-2">
                    @foreach ($event->keywords as $keyword)
                        <span class="px-2 py-1 bg-gray-300 text-gray-800 rounded text-xs">{{ $keyword->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
                <p class="text-sm font-semibold">🎭 Type d’événement :</p>
                <div class="flex gap-2">
                    @foreach ($event->types as $type)
                        <span class="px-2 py-1 bg-blue-300 text-blue-800 rounded text-xs">{{ $type->name }}</span>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('events.index') }}" class="px-3 py-2 bg-gray-500 text-white rounded">Retour</a>
                
                @if(Auth::user()->id === $event->created_by)
                    <a href="{{ route('events.edit', $event->id) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Modifier</a>

                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded">Supprimer</button>
                    </form>
                @endif

                @if(Auth::user()->hasRole('admin') && !$event->is_validated)
                    <form action="{{ route('events.validate', $event->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="px-3 py-2 bg-green-500 text-white rounded">Valider</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
