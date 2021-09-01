<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        return view('categories.index');
    }
}
