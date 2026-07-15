<h1>{{ $project->proj_name }}</h1>

@foreach ($project->tasks as $task)
    <p>{{ $task->title }}</p>
@endforeach