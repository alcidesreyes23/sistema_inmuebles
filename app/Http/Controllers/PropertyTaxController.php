<?php

namespace App\Http\Controllers;

use App\Models\PropertyTax;
use Illuminate\Http\Request;

class PropertyTaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        app(BinnacleController::class)->store("Insert", "Registro de nuevo tributo a una propiedad.", auth()->user()->name);
    }

    public function show(PropertyTax $propertyTax)
    {
        //
    }

    public function edit(PropertyTax $propertyTax)
    {
        //
    }

    public function update(Request $request, PropertyTax $propertyTax)
    {
        app(BinnacleController::class)->store("Update", "Actualizacion de tributo a una propiedad.", auth()->user()->name);
    }

    public function destroy(PropertyTax $propertyTax)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de tributo a una propiedad.", auth()->user()->name);
    }
}
