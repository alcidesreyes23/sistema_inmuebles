<?php

namespace App\Http\Controllers;

use App\Models\TaxType;
use Illuminate\Http\Request;

class TaxTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tax-types.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $newData = new TaxType();
            $newData->tipo_tributo = $request->tipo_tributo;
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo tipo de tributo.", auth()->user()->name);
            return response()->json();
        }
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = TaxType::all();
            return response()->json($data);
        }
    }

    public function edit($id, TaxType $taxType)
    {
        if (request()->ajax()) {
            $data = TaxType::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, TaxType $taxType)
    {
        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'tipo_tributo' => $data['tipo_tributo']
            ]);
            TaxType::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de tipo de tributo.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            TaxType::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de tipo de tributo.", auth()->user()->name);
            return response()->json();
        }
    }
}
