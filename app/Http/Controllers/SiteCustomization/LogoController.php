<?php

namespace App\Http\Controllers\SiteCustomization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function index()
    {
        return view('site_customization.logo');
    }
}
