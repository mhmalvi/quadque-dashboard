<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BulksController extends Controller
{
    /**
     * Import
     */
    public function import()
    {
        return view('bulks.import');
    }

    /**
     * Export
     */
    public function export()
    {
        return view('bulks.export');
    }
}
