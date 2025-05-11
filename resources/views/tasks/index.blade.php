@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Your Tasks</h2>
        <a href="{{ route('tasks.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
            Add Task
        </a>
    </div>

    @foreach ($tasks as $task)
        <div class="bg-white shadow-md rounded-lg p-5 mb-4 {{ $task->is_completed ? 'opacity-60' : '' }}">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                    <p class="text-gray-700 mt-1">{{ $task->description }}</p>
                    <span class="inline-block mt-2 text-sm {{ $task->is_completed ? 'text-green-600' : 'text-yellow-600' }}">
                        Status: {{ $task->is_completed ? 'Completed' : 'Pending' }}
                    </span>
                </div>
                <div class="flex space-x-2">
                    <form action="{{ route('tasks.toggleComplete', $task) }}" method="POST">
                        @csrf @method('PATCH')
                        <button class="px-3 py-1 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-md">
                            Toggle
                        </button>
                    </form>
                    <a href="{{ route('tasks.edit', $task) }}"
                       class="px-3 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                        Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="px-3 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-md"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Pagination -->
    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
