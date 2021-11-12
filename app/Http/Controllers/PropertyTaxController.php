<?php

namespace App\Http\Controllers;

use App\Models\PropertyTax;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Citizen;

class PropertyTaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Citizen::where("posee_inmueble","=","Si")->select("*")->get();
        return view("property-status.index",compact('data'));
    }

    public function detalles($id)
    {
        $data = Property::where("ciudadano_id","=",$id)
            ->select('properties.id','suburbs.id as idColonia','suburbs.colonia','property_types.tipo_inmueble','properties.calle','properties.total','properties.numero_inmueble')
                        ->join('suburbs','suburbs.id','=','properties.colonia_id')
                        ->join('property_types','property_types.id','=','properties.tipo_inmueble_id')
            ->get();

        return View('property-status.detalle',compact('id','data'));
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
