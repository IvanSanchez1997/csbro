<x-layouts.app>
<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 p-6">
    @if(session('info'))
    <div class="mb-4 rounded-lg bg-blue-100 text-blue-800 px-4 py-2">
        {{ session('info') }}
    </div>
    @endif
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-neutral-800 dark:text-neutral-100">
            Available games. Current Month
        </h2>
        <form action="{{ route('games.create') }}" method="GET">
            @csrf
        <button class="px-4 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shadow">
            New game
        </button>
        </form>
    </div>
    <div class="space-y-4 overflow-y-auto max-h-[70vh] pr-2">
        @foreach($games as $game)
        <!-- Tarjeta de partida -->
        <div class="flex items-center justify-between p-4 rounded-xl bg-white dark:bg-neutral-800 shadow-sm border border-neutral-200 dark:border-neutral-700">
            <div>
                <p class="font-medium text-neutral-900 dark:text-neutral-100">{{ $game->type }}</p>
                <p class="text-sm text-neutral-500 dark:text-neutral-400"> {{ $game->users_count }} jugadores </p>
                <p class="text-sm text-neutral-500 dark:text-neutral-400"> {{ $game->created_at }} </p>
            </div>
            
            <!-- Contenedor de botones -->
            <div class="flex gap-x-2">
                <form action="{{ route('games.join', $game) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1 text-sm rounded-lg bg-green-600 text-white hover:bg-green-700 shadow">
                        Join
                    </button>
                </form>
                <form action="{{ route('games.show', $game) }}" method="GET">
                    @csrf
                    <button type="submit" class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-600 shadow">
                        Show
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
</x-layouts.app>