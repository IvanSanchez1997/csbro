<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    public function join(Game $game)
{
    if ($game->users()->where('user_id', Auth::id())->exists()) {
            //return response('Ya estás dentro de esta partida.');
            return redirect()
                ->route('home')
                ->with('info', 'Ya estás dentro de esta partida.');
        }
    
    $game->users()->attach(Auth::id());

    return redirect()->route('games.show', $game); // o donde quieras redirigir
    
}

    public function show(Game $game)
    {
        // Cargar también los usuarios de la partida
        $game->load('users');

        return view('games.show', compact('game'));
    }

        public function create(Request $request)
    {
       $leader = Auth::id();
       $maps = ['Train', 'Nuke', 'Ancient', 'Overpass', 'Dust2', 'Mirage', 'Inferno'];
       $types = ['Faceit', 'Premier', 'Casual', 'Competitive'];

       return view('games.create', compact('maps', 'types', 'leader'));

    }

         public function store(Request $request)
    {

         $request->validate([
            'type' => ['required', Rule::in(['Faceit', 'Premier', 'Casual', 'Competitive'])],
            'preference' => ['nullable', 'array'],
            'preference.*' => [Rule::in(['Train', 'Nuke', 'Ancient', 'Overpass', 'Dust2', 'Mirage', 'Inferno'])]
        ]);

        $game = Game::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'preference' => $request->preference ? implode(',', $request->preference) : null
        ]);

        $game->users()->attach(Auth::id());

        return redirect()->route('games.show', $game)
            ->with('success', 'New game, waiting for players...');
    }
    
        }
