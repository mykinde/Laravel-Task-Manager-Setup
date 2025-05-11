@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Task</h2>

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6 bg-white shadow-md rounded-lg p-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('tasks.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300">
                Cancel
            </a>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                Create Task
            </button>
        </div>
    </form>
</div>
@endsection
