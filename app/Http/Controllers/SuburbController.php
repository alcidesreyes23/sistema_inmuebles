<?php

namespace App\Http\Controllers;

use App\Models\Suburb;
use Illuminate\Http\Request;

class SuburbController extends Controller
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
        app(BinnacleController::class)->store("Insert", "Registro de nuevo colonia.", auth()->user()->name);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = Suburb::all();
            return response()->json($data);
        }
    }

    public function edit(Suburb $suburb)
    {
        //
    }

    public function update(Request $request, Suburb $suburb)
    {
        app(BinnacleController::class)->store("Update", "Actualizacion de colonia.", auth()->user()->name);
    }

    public function destroy(Suburb $suburb)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de colonia.", auth()->user()->name);
    }
}
