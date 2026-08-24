<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index(Request $request): Response
    {
        $validate = $request->validate([
            "dueDateFrom" => "nullable|date",
            "dueDateTo" => "nullable|date|after_or_equal:dueDateFrom"
        ]);
        $projects = Project::query()
            ->when($validate['dueDateFrom'] ?? null, function($query, $date) {
                $query->whereDate('due_date', '>=', $date);
            })
            ->when($validate['dueDateTo'] ?? null, function($query, $date) {
                $query->whereDate('due_date', '<=', $date);
            })
            ->latest()
            ->get();
    
        return ProjectResource::collection(
            resource: $projects,
        )->toResponse($request);
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        return new ProjectResource(Project::create($validated));
    }

    public function show(Request $request, Project $project, string $id): Response
    {
        $project = Project::query()->findOrFail($id);

        return (new ProjectResource($project))
            ->toResponse($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
