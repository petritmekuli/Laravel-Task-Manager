<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class TaskController extends Controller
{
    public function index(Request $request){
        $tasksQueryBuilder = $request->user()->tasks()->latest();

        $tasksQueryBuilder = app(Pipeline::class)->send($tasksQueryBuilder)
            ->through([
                \App\QueryFilters\Priority::class,
                \App\QueryFilters\Status::class,
            ])->thenReturn();

        session()->flashInput([
            'priority-filter' => request()->input('priority'),
            'status-filter' => request()->input('status'),
        ]);

        $tasks = $tasksQueryBuilder->get();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
        ]);
        $request->user()->tasks()->create($validatedData);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function show(){
        // Since tasks didn't require much space and actions I decided to
        // manage them inline.
    }

    public function edit(Task $task){
        return view('tasks.edit', ['task' => $task]);
    }

    public function updateStatus(Task $task){
        $task->update(['status' => true]);
        return redirect()->route('tasks.index')
                         ->with('success', 'Task marked as done successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->merge([ 'status' => $request->filled('status')? 1 : 0, ]);

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'status' => 'required',
        ]);

        $task->fill($validatedData);

        if ($task->isDirty()) {
            $task->save();
            return redirect()->route('tasks.index')
                        ->with('success', 'Task was updated successfully.');
        } else {
            return redirect()->route('tasks.index')
                        ->with('error', 'No changes detected; task was not updated.');
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully.');
    }
}
