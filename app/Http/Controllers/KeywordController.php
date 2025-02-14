<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyword;
use Illuminate\Support\Facades\Auth;

class KeywordController extends Controller
{
    public function index() {
        $keywords = Keyword::all();
        return view('keywords.index', ['keywords' => $keywords]);
    }

    public function create() {
        return view('keywords.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:keywords|max:255',
        ]);

        Keyword::create(['name' => $request->name]);

        return redirect()->route('keywords.index')->with('success', 'Mot-clé ajouté !');
    }
}
