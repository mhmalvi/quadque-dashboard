<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductsCollection;
use App\Models\Category;
use App\Models\Product;
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
     * Get all products
     */
    public function getProducts()
    {
        try {
            return new ProductsCollection(
                Product::with(['category', 'brand'])
                    ->when(request('search', false), function ($query) {
                        $query->where(function ($q) {
                            $q->where('product', "LIKE", "%" . request('search') . "%")
                                ->orWhere('price', "LIKE", "%" . request('search') . "%")
                                ->orWhere('sku', "LIKE", "%" . request('search') . "%");
                        });
                    })
                    ->when(request('category', false), function ($query) {
                        $category = Category::where('slug', request('category'))->first()->id;
                        $query->where('category_id', $category);
                    })
                    ->paginate(request('items'))
            );
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
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
