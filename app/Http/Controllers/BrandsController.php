<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandUpdateRequest;
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
    public function getAllBrands()
    {
        try {
            return new BrandResourceController(Brand::all());
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 503);
        }
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
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $request->update($brand);

        return response()->json([
            'message' => "Successfully updated the brand!",
        ], 200);
    }

    /**
     * Delete
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'message' => "Successfully deleted the brand!",
        ], 200);
    }
}
