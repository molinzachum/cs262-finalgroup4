<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-slate-600">Milestones</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Milestone</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('milestones.update', $milestone) }}" class="max-w-3xl rounded-lg border border-[#D6E5EC] bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('milestones.form', ['milestone' => $milestone])
    </form>
</x-app-layout>
