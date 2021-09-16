<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Index
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Create
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store
     */
    public function store(ProductCreateRequest $request)
    {
        try {
            $request->save();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }
}
