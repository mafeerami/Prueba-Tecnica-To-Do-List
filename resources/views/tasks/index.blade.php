@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Tareas</h1>
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear Nueva Tarea</a>
        <div class="btn-group" role="group">
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary {{ request('filter') == '' ? 'active' : '' }}">Todas</a>
            <a href="{{ route('tasks.index', ['filter' => 'completed']) }}" class="btn btn-outline-success {{ request('filter') == 'completed' ? 'active' : '' }}">Completadas</a>
            <a href="{{ route('tasks.index', ['filter' => 'pending']) }}" class="btn btn-outline-warning {{ request('filter') == 'pending' ? 'active' : '' }}">No Completadas</a>
        </div>
    </div>
    <ul class="list-group">
        @foreach ($tasks as $task)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <h4 class="{{ $task->completed ? 'text-decoration-line-through' : '' }}">{{ $task->title }}</h4>
                <p>{{ $task->description }}</p>
            </div>
            <div>
                @if ($task->completed)
                <span class="badge bg-success">Completada</span>
                @else
                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Completar</button>
                </form>
                @endif
                @if (!$task->completed)
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary ms-2">Editar</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-2">Eliminar</button>
                </form>
                @endif
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
