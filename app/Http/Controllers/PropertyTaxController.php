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
        //
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
        //
    }

    public function destroy(PropertyTax $propertyTax)
    {
        //
    }
}
