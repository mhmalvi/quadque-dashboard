<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResourceCollection;

class CategoriesController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * 
     */
    public function getAllCategories()
    {
        try {
            // fetch all categories (children and parents)
            if(request()->has('children') && request()->get('children') == 'true')
            {
                return new CategoryResourceCollection(Category::all());
            }
            // fetch only parent categories
            else
            {
                return new CategoryResourceCollection(Category::where('level', '>', 0)->get());
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }

    /**
     * Paginated Categories
     */
    public function paginatedCategories(Request $request)
    {
        try {
            return new CategoryResourceCollection(
                Category::with('parent')
                    ->when(request('search', false), function ($query) {
                        $query->where(function ($q) {
                            $q->where('category', "LIKE", '%' . request('search') . '%')
                                ->orWhere('description', "LIKE", '%' . request('search') . '%');
                        });
                    })
                    ->paginate($request->items)
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }

    /**
     * Store
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $request->save();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }

    /**
     * Edit
     */
    public function edit(Category $category)
    {
        $all = Category::all();
        $category = $category->load('parent');
        return view('categories.edit', compact('category', 'all'));
    }

    /**
     * Update
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $request->update($category);

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }

    /**
     * Delete
     */
    public function destroy(Category $category)
    {
        try {
            Storage::disk('ftp')->delete('storage/categories/' . $category->icon);

            $category->delete();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }
}
