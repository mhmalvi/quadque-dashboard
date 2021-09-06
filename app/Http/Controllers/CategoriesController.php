<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Store
     */
    public function store(CreateCategoryRequest $request)
    {
        try {
            $request->save();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }
}
