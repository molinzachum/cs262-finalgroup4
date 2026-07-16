<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-slate-600">Tracking</p>
            <h1 class="text-2xl font-bold text-slate-950">Create Time Log</h1>
        </div>
    </x-slot>

    <form action="#" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @include('timelogs.form', ['timeLog' => null])
    </form>
</x-app-layout>
