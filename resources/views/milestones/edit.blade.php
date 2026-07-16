<x-app-layout>
    @php
        $milestone = (object) [
            'project_id' => 1,
            'title' => 'Wireframe Approval',
            'description' => 'Review project and milestone screens with the team.',
            'status' => 'In progress',
            'due_date' => '2026-07-20',
        ];
    @endphp

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-slate-600">Milestones</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Milestone</h1>
        </div>
    </x-slot>

    <form action="#" class="max-w-3xl rounded-lg border border-[#D6E5EC] bg-white p-6 shadow-sm">
        @include('milestones.form', ['milestone' => $milestone])
    </form>
</x-app-layout>
