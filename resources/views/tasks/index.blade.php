@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-2 gap-6">
    <!-- Pending Tasks -->
    <div>
        <div class="bg-yellow-50 rounded-lg p-4 mb-4">
            <h2 class="text-xl font-bold text-yellow-800">
                <i class="fas fa-clock mr-2"></i>
                Pending Tasks ({{ $pendingTasks->count() }})
            </h2>
        </div>
        
        @forelse($pendingTasks as $task)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="inline-block px-2 py-1 rounded text-xs text-white mb-2" 
                              style="background-color: {{ $task->category->color }}">
                            {{ $task->category->name }}
                        </span>
                        <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                        <p class="text-gray-600">{{ $task->description }}</p>
                        <p class="text-sm text-gray-500 mt-2">Due: {{ $task->due_date->format('M d, Y') }}</p>
                    </div>
                    <div class="flex gap-2">
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Complete</button>
                        </form>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No pending tasks</p>
        @endforelse
    </div>

    <!-- Completed Tasks -->
    <div>
        <div class="bg-green-50 rounded-lg p-4 mb-4">
            <h2 class="text-xl font-bold text-green-800">
                <i class="fas fa-check-circle mr-2"></i>
                Completed Tasks ({{ $completedTasks->count() }})
            </h2>
        </div>
        
        @forelse($completedTasks as $task)
            <div class="bg-white rounded-lg shadow-md p-4 mb-4 opacity-75">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="inline-block px-2 py-1 rounded text-xs text-white mb-2" 
                              style="background-color: {{ $task->category->color }}">
                            {{ $task->category->name }}
                        </span>
                        <h3 class="text-lg font-semibold line-through">{{ $task->title }}</h3>
                        <p class="text-gray-400 line-through">{{ $task->description }}</p>
                    </div>
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded">Reopen</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No completed tasks</p>
        @endforelse
    </div>
</div>
@endsection