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
        $data = Citizen::where("posee_inmueble", "=", "Si")->select("*")->get();
        return view("property-status.index", compact('data'));
    }

   /* public function addTax($id)
    {
        $data = DB::select('select tax.id, tax.tributo,pt.monto_pagado,pt.deuda_total, pt.created_at
        from property_taxes pt
        inner join properties inm on inm.id = pt.inmueble_id
        inner join taxes tax on tax.id = pt.tributo_id
        where inm.id = ?', [$id]);
        return view('account-statements.add-tax',compact('id','data'));
    }*/

    public function detalles($id)
    {
        $data = Property::where("ciudadano_id", "=", $id)
            ->select('properties.id', 'suburbs.id as idColonia', 'suburbs.colonia', 'property_types.tipo_inmueble', 'properties.calle', 'properties.total', 'properties.numero_inmueble')
            ->join('suburbs', 'suburbs.id', '=', 'properties.colonia_id')
            ->join('property_types', 'property_types.id', '=', 'properties.tipo_inmueble_id')
            ->get();

        return View('property-status.detalle', compact('id', 'data'));
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
        return view('account-statements.detalles-tax', compact('id', 'data'));
    }

    public function detAccount($id,$idI)
    {
        $fecha_creacion = PropertyTax::select('created_at')->where('tributo_id','=',$id)->where('inmueble_id','=',$idI)->get()->first()->created_at;
        $monto_fijo = PropertyTax::select('monto_fijo')->where('tributo_id','=',$id)->where('inmueble_id','=',$idI)->get()->first()->monto_fijo;
        $monto_pagado = PropertyTax::select('monto_pagado')->where('tributo_id','=',$id)->where('inmueble_id','=',$idI)->get()->first()->monto_pagado;
        $deuda_total = PropertyTax::select('deuda_total')->where('tributo_id','=',$id)->where('inmueble_id','=',$idI)->get()->first()->deuda_total;
        $meses = 13 - date('m', strtotime($fecha_creacion));
        $mes_actual = date('m');
        $meses_pago = 13 - $mes_actual;
        $meses_esperado = $meses - $meses_pago;
        $pago_esperado = $monto_fijo * $meses_esperado;

        if($pago_esperado == $monto_pagado) {
            $estado = "EN LINEA";
        } else {
            $estado = "MOROSO";
        }

        if($meses_esperado == 0) {
            $rango_f = 'NO FACTURADO';
            $deuda = 0;
        } else {
            $rango_f = date('F', strtotime($fecha_creacion)).' to '.date('F',strtotime('2021-'.($mes_actual - 1)));
            $deuda = $pago_esperado - $monto_fijo;
        }

        $data2 = [
            'meses' => $meses_esperado,
            'rango' => $rango_f,
            'pago' => number_format($monto_fijo,2),
            'monto_pagado' => number_format($monto_pagado,2),
            'monto_esperado' => number_format($pago_esperado,2),
            'deuda' => number_format($deuda,2),
            'deuda_total' => number_format($deuda_total,2),
            'estado' => $estado
        ];

        return view('account-statements.detalles-account', compact('id','data2'));
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
