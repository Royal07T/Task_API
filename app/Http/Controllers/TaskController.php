<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display a listing of tasks.
    public function index()
    {
        return response()->json(Task::all(), 200);
    }

    // Store a new task in the database.
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',  // Ensure title is required, a string, and max length of 255
            'description' => 'nullable|string',    // Description is optional and can be a string
            'status' => 'required|in:pending,completed', // status must be one of the specified values
        ]);

        // Create and store the task
        $task = Task::create($validated);  // Use only validated data
        return response()->json($task, 201);
    }

    // Display the specified task.
    public function show($id)
    {
        $task = Task::findOrFail($id);  // Find or fail will automatically return a 404 if not found
        return response()->json($task, 200);
    }

    // Update the specified task in the database.
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',  // Ensure title is required, a string, and max length of 255
            'description' => 'nullable|string',    // Description is optional and can be a string
            'status' => 'required|in:pending,completed', // status must be one of the specified values
        ]);

        // Find the task or fail
        $task = Task::findOrFail($id);

        // Update task with validated data
        $task->update($validated);

        return response()->json($task, 200);
    }

    // Remove the specified task from the database.
    public function destroy($id)
    {
        Task::destroy($id);  // This will delete the task with the provided ID
        return response()->json(null, 204);  // Return a 204 (No Content) response after deletion
    }
}
