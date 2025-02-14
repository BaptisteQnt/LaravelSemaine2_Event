<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Événements
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Événements disponibles</h3>
                <a href="{{ route('events.create') }}" class="px-4 py-2 bg-green-500 text-white rounded">
                    + Créer un événement
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-700">{{ $event->description }}</p>
                        <p class="text-sm mt-2">📍 <strong>Lieu :</strong> {{ $event->location }}</p>
                        <p class="text-sm">🎟 <strong>Places :</strong> {{ $event->places ?? 'Non spécifié' }}</p>
                        
                        
                        <p class="text-sm mt-2"><strong>Dates :</strong></p>
                        <ul class="text-sm text-gray-600">
                            @foreach ($event->dates as $date)
                                <li>📅 {{ \Carbon\Carbon::parse($date->date)->format('d/m/Y H:i') }}</li>
                            @endforeach
                        </ul>

                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('events.show', $event->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Voir</a>
                            
                            @if(Auth::user()->id === $event->created_by)
                                <a href="{{ route('events.edit', $event->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Modifier</a>
                                
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Supprimer</button>
                                </form>
                            @endif

                            @if(Auth::user()->hasRole('admin') && !$event->is_validated)
                                <form action="{{ route('events.validate', $event->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded">Valider</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
