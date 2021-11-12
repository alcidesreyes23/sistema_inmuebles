<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Property;
use App\Models\PropertyTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function detCitizens()
    {
        $data = Citizen::where('citizens.posee_inmueble', '=', 'Si')->select('*')->get();
        return view('account-statements.index', compact('data'));
    }

    public function detProperties($id)
    {
        $data = Property::where("ciudadano_id", "=", $id)
            ->select('properties.id', 'suburbs.id as idColonia', 'suburbs.colonia', 'property_types.tipo_inmueble', 'properties.pasaje', 'properties.calle', 'properties.ancho', 'properties.largo', 'properties.total', 'properties.numero_inmueble')
            ->join('suburbs', 'suburbs.id', '=', 'properties.colonia_id')
            ->join('property_types', 'property_types.id', '=', 'properties.tipo_inmueble_id')
            ->get();;
        return view('account-statements.detalles-inmueble', compact('id', 'data'));
    }

    public function detTaxes($id)
    {
        $data = DB::select('select tax.id, tax.tributo,pt.monto_pagado,pt.deuda_total, pt.created_at
        from property_taxes pt
        inner join properties inm on inm.id = pt.inmueble_id
        inner join taxes tax on tax.id = pt.tributo_id
        where inm.id = ?', [$id]);
        return view('account-statements.detalles-tax',compact('id','data'));
    }

    public function detAccount($id)
    {
        return view('account-statements.detalles-account',compact('id'));
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
