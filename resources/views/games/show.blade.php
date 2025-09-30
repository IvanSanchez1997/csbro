<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Partida: {{ $game->type }}
        </h1>

        <h2 class="text-xl mb-2">Jugadores</h2>
        <ul class="list-disc list-inside">
            @foreach($game->users as $user)
                <li>{{ $user->name }} </li>
            @endforeach
        </ul>
        <p> Prefer {{ $game->preference }}</p>

        <a href="{{ url('/dashboard') }}" 
           class="inline-block mt-4 px-4 py-2 rounded-lg bg-blue-600 text-white">
            Volver
        </a>
    </div>
    <livewire:chat :game-id="$game->id" />
</x-layouts.app>
