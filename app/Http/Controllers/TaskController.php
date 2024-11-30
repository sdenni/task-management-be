<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::all());
    }

    public function store(Request $request)
    {
        try {
        
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'in:pending,in-progress,completed',
                'deadline' => 'nullable|date',
                'user_id' => 'required|exists:users,id',
            ]);
    
            $task = Task::create($validated);
            
            Log::info('Task created', ['task_id' => $task->id]);
            
            return response()->json($task, 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
                'message' => 'Validation failed',
            ], 422);
        }
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        try {
            
            $validated = $request->validate([
                'title' => 'string|max:255',
                'description' => 'nullable|string',
                'status' => 'in:pending,in-progress,completed',
                'deadline' => 'nullable|date',
                'user_id' => 'exists:users,id',
            ]);
            
            $task->update($validated);
            
            return response()->json($task);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
                'message' => 'Validation failed',
            ], 422);
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
