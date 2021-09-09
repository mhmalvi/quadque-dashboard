<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        dd($request->all());
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
