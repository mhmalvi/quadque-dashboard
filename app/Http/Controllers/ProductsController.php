<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
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
            // if request has category, filter by that category
            if(request()->has('category'))
            {
                $category = Category::where('category', request()->get('category'))->first();

                return new ProductsCollection(
                    $category->products
                );
            }
            // or else, fetch all products
            else
            {
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
            }
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

    public function edit(Product $product)
    {
        $product->load("brand", "category");
        return view('products.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $request->update($product);
        return response()->json([
            'message' => "Updated the product successfully!",
        ], 200);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => "Product deleted successfully!",
        ], 200);
    }
}
