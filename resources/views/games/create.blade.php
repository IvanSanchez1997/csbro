<x-layouts.app>

<div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 p-6">
<!-- Título de la sección -->
<div class="flex items-center justify-between mb-4">
<h2 class="text-xl font-semibold text-neutral-800 dark:text-neutral-100">
Create new game
</h2>
</div>

<!-- Formulario de creación de partida -->

<form action="{{ route('games.store') }}" method="POST" class="space-y-6">
@csrf
<input type="hidden" name="leader" id="leader" value= "{{ $leader }}">
<!-- Selector de tipo de partida (radios) -->
<div>
    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
        Game Type
    </label>
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach($types as $type)
            <div class="flex items-center">
                <input type="radio" name="type" id="type_{{ strtolower($type) }}" value="{{ $type }}"
                    class="h-4 w-4 rounded border-neutral-300 text-indigo-600 focus:ring-indigo-500 dark:border-neutral-600 dark:bg-neutral-700">
                <label for="type_{{ strtolower($type) }}" class="ml-2 block text-sm text-neutral-900 dark:text-neutral-200">
                    {{ $type }}
                </label>
            </div>
        @endforeach
    </div>
</div>

<!-- Selector de preference de mapas -->
<div>
    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
        Map preference Preference (optional)
    </label>
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach($maps as $map)
            <div class="flex items-center">
                <input type="checkbox" name="preference[]" id="preference_{{ strtolower($map) }}" value="{{ $map }}"
                    class="h-4 w-4 rounded border-neutral-300 text-indigo-600 focus:ring-indigo-500 dark:border-neutral-600 dark:bg-neutral-700">
                <label for="preference_{{ strtolower($map) }}" class="ml-2 block text-sm text-neutral-900 dark:text-neutral-200">
                    {{ $map }}
                </label>
            </div>
        @endforeach
    </div>
</div>

<!-- Botón para crear la partida -->
<div class="pt-4">
    <button type="submit"
        class="w-full px-4 py-2 text-sm font-medium rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Create game
    </button>
</div>

</form>

</div>

</x-layouts.app>