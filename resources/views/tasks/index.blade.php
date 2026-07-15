<x-app-layout>
    @foreach ($tasks as $task)
        {{$task->title;}}
    @endforeach
</x-app-layout>