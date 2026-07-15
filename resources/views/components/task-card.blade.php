@props(['tasks'])

<a href="{{ route('tasks.show', $task) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition duration-150 ease-in-out">

    <div class="aspect-square bg-gray-50 overflow-hidden">
        {{-- @if ($task->hasMedia())
            <img
                src="{{ $product->getFirstMediaUrl() }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover"
            > --}}
        {{-- @else --}}
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        {{-- @endif --}}
    </div>

    <div class="p-4 flex flex-col flex-1 gap-1">
        {{-- @if ($task->project)
            <span class="text-xs font-semibold text-lime-400 uppercase tracking-wide">
                {{ $task->project->name }}
            </span>
        @endif --}}
        <span class="text-xs font-semibold text-lime-400 uppercase tracking-wide">
                Project 1
            </span>

        <h3 class="font-semibold text-gray-900 leading-snug line-clamp-1">
            {{-- {{ $task->name }} --}}
            Task 1
        </h3>

        <p class="text-sm text-gray-500 line-clamp-2 flex-1">
            {{-- {{ $task->description }} --}}
            Create Figma design.
        </p>

        <div class="flex items-center justify-between pt-3 mt-auto border-t border-gray-100">
            <span class="text-lg font-bold text-gray-900">
                {{-- ${{ number_format($task->price, 2) }} --}}
            </span>
            {{-- <span class="text-xs {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-500' }}"> --}}
                {{-- {{ $product->stock_quantity > 0 ? $product->stock_quantity . ' in stock' : 'Out of stock' }} --}}
            <span>
                
            </span>
        </div>
    </div>
</a>
