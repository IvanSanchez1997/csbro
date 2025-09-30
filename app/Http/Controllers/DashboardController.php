<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Game;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $games = Game::withCount('users')
        ->where('created_at', '>=', now()->subMonth())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('dashboard', compact('games'));
    }
}
