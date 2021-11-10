<?php

namespace App\Http\Controllers;

use App\Models\ResidenceArea;
use Illuminate\Http\Request;

class ResidenceAreaController extends Controller
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
        app(BinnacleController::class)->store("Insert", "Registro de nuevo area de residencia.", auth()->user()->name);
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = ResidenceArea::all();
            return response()->json($data);
        }
    }

    public function edit(ResidenceArea $residenceArea)
    {
        //
    }

    public function update(Request $request, ResidenceArea $residenceArea)
    {
        app(BinnacleController::class)->store("Update", "Actualizacion de area de residencia.", auth()->user()->name);
    }

    public function destroy(ResidenceArea $residenceArea)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de area de residencia.", auth()->user()->name);
    }
}
