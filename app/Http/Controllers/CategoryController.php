<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(Request $request): Response
    {
        return CategoryResource::collection(
            resource: Category::all()
        )->toResponse($request);
    }

    public function store(StoreCategoryRequest $request): CategoryResource
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    public function show(Request $request, Category $category, string $id): Response
    {
        $category = Category::query()->findOrfail($id);

        return (new CategoryResource($category))
            ->toResponse($request);
    }
}
