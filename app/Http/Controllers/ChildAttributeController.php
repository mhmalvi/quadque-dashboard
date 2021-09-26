<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChildAttributeCreateRequest;

class ChildAttributeController extends Controller
{
    public function store(ChildAttributeCreateRequest $request)
    {
        $request->save();

        return response()->json([
            'message' => "Successfully added the new attribute!",
        ], 200);
    }
}
