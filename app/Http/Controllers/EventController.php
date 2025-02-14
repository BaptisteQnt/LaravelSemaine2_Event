<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Keyword;
use App\Models\EventDate;
use App\Models\Type;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        $keywords = Keyword::all();
        return view('events.index', ['events' => $events, 'keywords' => $keywords]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $keywords = Keyword::all();
        $types = Type::all();
        return view('events.create',['keywords' => $keywords, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'places' => 'nullable|integer|min:1',
            'location' => 'required|string|max:255',
            'dates' => 'required|array',
            'keywords' => 'array',
            'types' => 'array',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'places' => $request->places,
            'location' => $request->location,
            'created_by' => Auth::id(),
            'is_validated' => false,
        ]);

        foreach ($request->dates as $date) {
            EventDate::create([
                'event_id' => $event->id,
                'date' => $date,
            ]);
        }
            
        $event->keywords()->attach($request->keywords);
        $event->types()->attach($request->types);

        return redirect()->route('events.index')->with('success', 'Evenement créé avec succes ! En attente de validation.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if(Auth::id() !== $event->created_by) {
            abort(403);
        }
        $keywords = Keyword::all();
        $selectedKeywords = $event->keywords()->pluck('id')->toArray() ?? [];
        $types = Type::all();
        $selectedTypes = $event->types()->pluck('id')->toArray();

        return view('events.edit', ['event' => $event, 'keywords' => $keywords, 'selectedKeywords' => $selectedKeywords, 'types' => $types, 'selectedTypes' => $selectedTypes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        if(Auth::id() !== $event->created_by) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'places' => 'nullable|integer|min:1',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Évévenent mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Évenement supprimé.');
    }

    public function validateEvent(Event $event) 
    {
        $event->update(['is_validated' => true]);

        return redirect()->route('events.index')->with('success', 'Événement validé.');
    }
}
