<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitTypesCollection;
use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypesController extends Controller
{
    public function getUnitTypes()
    {
        return new UnitTypesCollection(UnitType::all());
    }
}
