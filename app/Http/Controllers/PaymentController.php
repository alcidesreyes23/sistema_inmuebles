<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        app(BinnacleController::class)->store("Insert", "Registro de nuevo pago.", auth()->user()->name);
    }

    public function show(Payment $payment)
    {
        //
    }

    public function edit(Payment $payment)
    {
        //
    }

    public function update(Request $request, Payment $payment)
    {
        app(BinnacleController::class)->store("Update", "Actualizacion de pago.", auth()->user()->name);
    }

    public function destroy(Payment $payment)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de pago.", auth()->user()->name);
    }
}
