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
        $data = Suburb::all();
        return view('suburb.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'colonia' => 'required'
        ]);

        if ($request->ajax()) {
            $newData = new Suburb();
            $newData->colonia = $request->colonia;
            $newData->cantidad = 0;
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo colonia.", auth()->user()->name);
            return response()->json();
        }
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = Suburb::all();
            return response()->json($data);
        }
    }

    public function edit($id,Suburb $suburb)
    {
        if (request()->ajax()) {
            $data = Suburb::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, Suburb $suburb)
    {
        $request->validate([
            'colonia' => 'required',
            'cantidad' => 'required|integer'
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'colonia' => $data['colonia'],
                'cantidad' => $data['cantidad'],
            ]);
            Suburb::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de colonia.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id,Suburb $suburb)
    {
        if (request()->ajax()) {
            Suburb::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de colonia.", auth()->user()->name);
            return response()->json();
        }
    }
}
