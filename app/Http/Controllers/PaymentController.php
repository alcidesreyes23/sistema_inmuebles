<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Payment;
use App\Models\PropertyTax;
use App\Models\SubdivisionTax;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Property::select(
            'properties.id as id',
            'properties.numero_inmueble as num',
            'properties.calle as calle',
            'citizens.nombres as nombres',
            'citizens.apellidos as apellidos',
            'citizens.dui as dui',
            'citizens.nit as nit'
        )
            ->join('citizens', 'citizens.id', '=', 'properties.ciudadano_id')
            ->get();
        return view("pagos.index", compact('data'));
    }

    public function getSubT($id)
    {
        if (request()->ajax()) {
            $data = SubdivisionTax::where('subdivision_taxes.tributo_id', '=', $id)->select('*')->get();
            return response()->json($data);
        }
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'inmueble_id' => 'required',
            'tributo_id' => 'required',
            'mes' => 'required',
        ]);

        if (request()->ajax()) {
            $sub_id = ($request->sub_id != null) ? $request->sub_id : 0;
            $tax_id = $request->tributo_id;
            $inmueble_id = $request->inmueble_id;
            $fecha = $request->mes;
            $costoTax = Tax::select('taxes.costo')->where('taxes.id', '=', $tax_id)->get()->first()->costo;
            $longitud = Property::select('properties.total')->where('properties.id', '=', $inmueble_id)->get()->first()->total;
            if ($sub_id != 0) {
                $costoTax = SubdivisionTax::select('subdivision_taxes.costo')->where('subdivision_taxes.id', '=', $sub_id)->get()->first()->costo;
            }
            $pagoTotal = ($tax_id == 1) ? sqrt($longitud) * $costoTax : (($sub_id == 5) ? $costoTax : $longitud * $costoTax);
            if (date('L') == date('L', strtotime($fecha))) {
                if (date('M') == date('M', strtotime($fecha))) {
                    $mora = 0;
                } else $mora = 1;
            } else $mora = 1;
            $pagoTotal += $mora;
            $data = ['saldo' => number_format($pagoTotal, 2), 'mora' => $mora, 'pagoT' => number_format($pagoTotal, 2)];
            return response()->json($data);
        }
    }

    public function create()
    {
        //
    }

    public function factura($id)
    {
        $taxes = Tax::all();
        return View('pagos.factura', compact('id', 'taxes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inmueble_id' => 'required',
            'tributo_id' => 'required',
            'monto_pago' => 'required|numeric',
            'saldo' => 'required|numeric|min:0',
            'mora' => 'required|numeric',
            'total_pagar' => 'required|numeric',
            'mes' => 'required',
        ]);

        if ($request->ajax()) {
            $mora = $request->mora;
            $newData = new Payment();
            $newData->tributo_id = $request->tributo_id;
            $newData->monto_pago = $request->monto_pago;
            $newData->saldo = $request->saldo;
            $newData->mora = $mora;
            $newData->total_pagar = $request->total_pagar;
            $newData->save();

            $lastId = Payment::latest('id')->first()->id;
            $monto_f = ($mora != 0) ? $request->monto_pago - $mora: $request->monto_pago;
            PropertyTax::where('tributo_id',$request->tributo_id)->where('inmueble_id',$request->inmueble_id)->increment('monto_pagado',$monto_f);
            app(PropertyTaxPaymentController::class)->store($lastId, $request);
            app(BinnacleController::class)->store("Insert", "Registro de nuevo pago.", auth()->user()->name);
            return response()->json();
        }
    }

    public function detalles($id)
    {
        $data = DB::select('select ptp.inmueble_id,ptp.mes, ptp.anio, ptp.pago_id,p.tributo_id,p.created_at,p.monto_pago,p.saldo,p.mora,p.total_pagar,t.tributo
        from property_tax_payments as ptp
        inner join payments p on p.id = ptp.pago_id
        inner join taxes t on t.id = p.tributo_id
        where ptp.inmueble_id = ?', [$id]);
        return View('pagos.detalle', compact('id','data'));
    }

    public function show(Payment $payment)
    {
        //
    }

    public function edit($id)
    {
        $data = DB::select('select ptp.inmueble_id,ptp.mes, ptp.anio, ptp.pago_id,p.tributo_id,p.monto_pago,p.saldo,p.mora,p.total_pagar,t.tributo
        from property_tax_payments as ptp
        inner join payments p on p.id = ptp.pago_id
        inner join taxes t on t.id = p.tributo_id
        where p.id = ?', [$id]);
        return View('pagos.update', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'monto_pago' => 'required|numeric',
            'saldo' => 'required|numeric|min:0',
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'monto_pago' => ($data['monto_pago'] + $data['monto_old']),
                'saldo' => $data['saldo'],
            ]);
            Payment::where('id', '=', $request->pago_id)->update($array);
            PropertyTax::where('tributo_id',$request->tributo_id)->where('inmueble_id',$request->inmueble_id)->increment('monto_pagado',$request->monto_pago);
            app(BinnacleController::class)->store("Update", "Actualizacion de pago.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy(Payment $payment)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de pago.", auth()->user()->name);
    }
}
