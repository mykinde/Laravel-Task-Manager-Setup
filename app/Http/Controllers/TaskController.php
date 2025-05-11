<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskController extends Controller
{
    use AuthorizesRequests;

    
    
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        auth()->user()->tasks()->create($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $request->validate(['title' => 'required']);

        $task->update($request->only('title', 'description'));

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    public function toggleComplete(Task $task)
    {
        $this->authorize('update', $task);
        $task->is_completed = !$task->is_completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status updated.');
    }
}

