<x-app-layout>

    <x-slot name="header">
        <h1 class="text-2xl font-bold">
            Tasks Test
        </h1>
    </x-slot>

    <div>
        Total tasks: {{ $tasks->count() }}
    </div>

</x-app-layout>