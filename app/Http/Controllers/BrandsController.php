<?php

namespace App\Http\Controllers;

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
}
