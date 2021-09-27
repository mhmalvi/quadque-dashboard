<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChildAttributeCreateRequest;
use App\Http\Resources\ChildAttributesCollection;
use App\Models\Attribute;
use App\Models\ChildAttribute;

class ChildAttributeController extends Controller
{
    public function all(Attribute $attribute)
    {
        return new ChildAttributesCollection(
            $attribute->children()->paginate(2)
        );
    }

    public function store(ChildAttributeCreateRequest $request)
    {
        $request->save();

        return response()->json([
            'message' => "Successfully added the new attribute!",
        ], 200);
    }

    public function destroy(Attribute $attribute, ChildAttribute $childAttribute)
    {
        $childAttribute->delete();
        return response()->json([
            'message' => "Successfully deleted the child attribute!",
        ], 200);
    }
}
