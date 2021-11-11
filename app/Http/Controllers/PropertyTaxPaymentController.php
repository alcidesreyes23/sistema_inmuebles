<?php

namespace App\Http\Controllers;

use App\Models\PropertyTaxPayment;
use Illuminate\Http\Request;

class PropertyTaxPaymentController extends Controller
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

    public function store($id,Request $request)
    {
        if ($request->ajax()) {
            $fecha = $request->mes;
            $newData = new PropertyTaxPayment();
            $newData->pago_id = $id;
            $newData->inmueble_id = $request->inmueble_id;
            $newData->anio = date('Y',strtotime($fecha));
            $newData->mes = date('m',strtotime($fecha));
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo pago de tributos sobre la propiedad.", auth()->user()->name);
        }
    }

    public function show()
    {
        //return View('pagos.factura',compact('id'));
    }

    public function edit(PropertyTaxPayment $propertyTaxPayment)
    {
        //
    }

    public function update(Request $request, PropertyTaxPayment $propertyTaxPayment)
    {
        app(BinnacleController::class)->store("Update", "Actualizacion de pago de tributos sobre la propiedad.", auth()->user()->name);
    }

    public function destroy(PropertyTaxPayment $propertyTaxPayment)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de pago de tributos sobre la propiedad.", auth()->user()->name);
    }
}
