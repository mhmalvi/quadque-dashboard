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
}
