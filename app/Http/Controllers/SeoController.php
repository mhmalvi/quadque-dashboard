<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Index
     */
    public function index()
    {
        return view('seo.index');
    }
}
