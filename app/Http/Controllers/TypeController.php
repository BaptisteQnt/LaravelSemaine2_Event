<?php

namespace App\Http\Controllers;
use App\Models\Type;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index() {
        $types = Type::all();
        return view('types.index', ['types' => $types]);
    }

    public function create() {
        return view('types.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|string|unique:types|max:255',
        ]);

        Type::create(['name' => $request->name]);

        return redirect()->route('types.index')->with('success', 'Type ajouyé avec succes');
    }

    public function edit(Type $type) {
        return view('types.edit', ['type' => $type]);
    }

    public function update(Request $request, Type $type) {
        $request->validate([
            'name' => 'required|string|unique:types,name,'.$type->id.'|max:255',
        ]);

        $type->update(['name' => $request->name]);

        return redirect()->route('types.index')->with('success', 'Type mis à jour avec succes');
    }

    public function destroy(Type $type) {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Type supprimé avec succès !');
    }
}
