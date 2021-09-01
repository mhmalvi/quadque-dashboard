<?php

namespace App\Http\Controllers;

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
}
