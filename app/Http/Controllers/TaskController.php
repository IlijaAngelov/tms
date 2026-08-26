<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index(Request $request): Response
    {
        $validated = $request->validate([
            'category' => "nullable|integer",
            'status' => "nullable|string"
        ]);

        $tasks = Task::query()
        ->when($validated['category'] ?? null, function($query, $category) {
            $query->where('category_id', $category);
        })
        ->when($validated['status'] ?? null, function($query, $status) {
            $query->where('status', $status);
        })
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return TaskResource::collection(
            resource: $tasks
        )->toResponse($request);
    }

    public function store(StoreTaskRequest $request)
    {
        return new TaskResource(Task::create($request->validated()));
    }

    public function show(Request $request, Task $task, string $id): Response
    {
        $task = Task::query()->findOrFail($id);

        return (new TaskResource($task))
            ->toResponse($request);
    }

    public function update(Request $request, Task $task, string $id): Response
    {
        $task = Task::query()->findOrFail($id);
        
        $task->update(['status' => 'completed']);

        return (new TaskResource($task))
            ->toResponse($request);

    }
}
