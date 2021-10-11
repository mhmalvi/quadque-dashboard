<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedProduct;
use App\Http\Resources\FeaturedProductCollection;
use App\Http\Requests\FeaturedProductCreateRequest;
use App\Http\Requests\FeaturedProductUpdateRequest;

class FeaturedProductsController extends Controller
{
    public function index()
    {
        return view('featured_products.index');
    }

    public function getFeaturedProducts()
    {
        return new FeaturedProductCollection(
            FeaturedProduct::with('product')->paginate(request('items'))
        );
    }

    public function store(FeaturedProductCreateRequest $request)
    {
        $request->save();

        return response()->json([
            'message' => "Successfully created the featured products",
        ], 200);
    }

    public function update(FeaturedProductUpdateRequest $request, FeaturedProduct $featured_product)
    {
        $request->update($featured_product);

        return response()->json([
            'message' => "Successfully updated the featured product's status",
        ], 200);
    }

    // /**
    //  * Get all products
    //  */
    // public function getProducts()
    // {
    //     try {
    //         // if request has category, filter by that category
    //         if (request()->has('category')) {
    //             $category = Category::where('category', request()->get('category'))->first();

    //             return new ProductsCollection(
    //                 $category->products
    //             );
    //         }
    //         // or else, fetch all products
    //         else {
    //             return new ProductsCollection(
    //                 Product::with(['category', 'brand'])
    //                     ->when(request('search', false), function ($query) {
    //                         $query->where(function ($q) {
    //                             $q->where('product', "LIKE", "%" . request('search') . "%")
    //                                 ->orWhere('price', "LIKE", "%" . request('search') . "%")
    //                                 ->orWhere('sku', "LIKE", "%" . request('search') . "%");
    //                         });
    //                     })
    //                     ->when(request('category', false), function ($query) {
    //                         $category = Category::where('slug', request('category'))->first()->id;
    //                         $query->where('category_id', $category);
    //                     })
    //                     ->paginate(request('items'))
    //             );
    //         }
    //     } catch (\Throwable $th) {
    //         return response()->json(['message' => $th->getMessage()], 503);
    //     }
    // }
}
