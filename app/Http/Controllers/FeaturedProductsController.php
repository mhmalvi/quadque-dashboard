<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedProduct;
use App\Http\Resources\FeaturedProductCollection;

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
}
