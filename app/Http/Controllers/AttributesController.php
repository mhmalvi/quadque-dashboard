<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Http\Requests\AttributeCreateRequest;
use App\Http\Resources\AttributeCollection;

class AttributesController extends Controller
{
    public function index()
    {
        return view('attributes.index');
    }
    public function getAttributes()
    {
        try
        {
            return new AttributeCollection(
                Attribute::when(request('search', false), function ($query)
                {
                    $query->where('attribute', "LIKE", '%' . request('search') . '%')
                        ->orWhere('description', "LIKE", '%'. request('search') .'%');
                })
                ->paginate(request('items'))
            );
        }
        catch(\Throwable $e)
        {
            return response()->json([
                'messsage' => $e->getMessage()
            ], 503);
        }
    }

    public function create()
    {
        return view('attributes.create');
    }

    public function store(AttributeCreateRequest $request)
    {
        $request->save();
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return response()->json(['message' => "Successfully deleted the attribute!"], 200);
    }
}
