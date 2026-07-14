<h1>{{ $project->proj_name }}</h1>

<h2>Team Members</h2>

<p>Total Members: {{ $members->count() }}</p>

<p>Total Admins:
    {{ $members->where('member_role', 'Admin')->count() }}
</p>

<hr>

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


    <h4>Active Tasks:</h4>

    @foreach($member->user->taskAssignments as $assignment)

        @if($assignment->task->status != 'Completed')

            <p>
                {{ $assignment->task->title }}
            </p>

        @endif

    @endforeach


</div>

<hr>

@endforeach