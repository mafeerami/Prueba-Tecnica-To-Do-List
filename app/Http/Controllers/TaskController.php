<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Task::where('user_id', auth()->id());

    if ($request->has('filter')) {
        if ($request->filter == 'completed') {
            $query->where('completed', true);
        } elseif ($request->filter == 'pending') {
            $query->where('completed', false);
        }
    }

    $tasks = $query->get();

    return view('tasks.index', compact('tasks'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        // Asegurarse de que el usuario autenticado solo pueda editar sus propias tareas
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Asegurarse de que el usuario autenticado solo pueda actualizar sus propias tareas
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }
    public function destroy(Task $task)
    {
        if ($task->completed) {
            abort(403, 'No puedes eliminar una tarea completada.');
        }
    
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
    
        $task->delete();
    
        return redirect()->route('tasks.index');
    }
    

    public function complete(Task $task)
    {
        // Asegurarse de que el usuario autenticado solo pueda completar sus propias tareas
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->completed = true;
        $task->save();

        return redirect()->route('tasks.index');
    }
}
