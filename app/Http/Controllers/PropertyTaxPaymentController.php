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

    public function store(Request $request)
    {
        app(BinnacleController::class)->store("Insert", "Registro de nuevo pago de tributos sobre la propiedad.", auth()->user()->name);
    }

    public function show(PropertyTaxPayment $propertyTaxPayment)
    {
        //
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
