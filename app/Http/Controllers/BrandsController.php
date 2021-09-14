<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandCreateRequest;
use App\Http\Resources\BrandResourceController;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Index
     */
    public function index()
    {
        return view('brands.index');
    }

    /**
     * Paginated Brands
     */
    public function paginatedBrands(Request $request)
    {
        try {
            return new BrandResourceController(
                Brand::orderBy('created_at', 'desc')->paginate($request->item)
            );
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * All brands
     */
    public function getBrands()
    {
    }

    /**
     * Store
     */
    public function store(BrandCreateRequest $request)
    {
        try {
            $brand = $request->save();

            return response()->json(['data' => $brand, 'message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
    }

    /**
     * Edit
     */
    public function edit(Brand $brand)
    {
    }

    /**
     * Update
     */
    public function update(Request $request, Brand $brand)
    {
    }

    /**
     * Delete
     */
    public function destroy(Brand $brand)
    {
    }
}
