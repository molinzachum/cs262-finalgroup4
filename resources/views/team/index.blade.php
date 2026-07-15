<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-emerald-600">Workspace</p>
            <h1 class="text-2xl font-bold text-slate-950">
                {{ $project->proj_name }}
            </h1>
        </div>
    </x-slot>

    <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">

        <h2 class="text-lg font-semibold text-slate-950">
            Team Members
        </h2>

        <p>Total Members: {{ $members->count() }}</p>

        <p>
            Total Admins:
            {{ $members->where('member_role', 'Admin')->count() }}
        </p>

        <hr class="my-4">

        <form method="GET" action="">
            <input
                type="text"
                name="search"
                placeholder="Search members..."
                value="{{ $search ?? '' }}"
            >

            <button type="submit">
                Search
            </button>
        </form>

        <br>

        @foreach($members as $member)

            <div>

                <strong>
                    {{ $member->user->name }}
                </strong>

                <br>

                Email:
                {{ $member->user->email }}

                <br>

                Role:
                {{ $member->member_role }}

                <br>

                Joined:
                {{ $member->joined_date }}

                <h4>Active Tasks</h4>

                @foreach($member->user->taskAssignments as $assignment)

                    @if($assignment->task->status != 'Completed')

                        <p>
                            {{ $assignment->task->title }}
                        </p>

                    @endif

                @endforeach

            </div>

            <hr class="my-4">

        @endforeach

    </section>
</x-app-layout>