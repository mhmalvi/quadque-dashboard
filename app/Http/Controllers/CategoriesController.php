<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use Illuminate\Http\Request;

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
     * Get data
     */
    public function getCategories(Request $request)
    {
        return new CategoryResourceCollection(Category::with('parent')->paginate($request->items));
    }

    /**
     * Store
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            $category = $request->save();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }
}
