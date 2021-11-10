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
        $data = ResidenceArea::all();
        return view('residence-area.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona' => 'required'
        ]);

        if ($request->ajax()) {
            $newData = new ResidenceArea();
            $newData->zona = $request->zona;
            $newData->cantidad = 0;
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo area de residencia.", auth()->user()->name);
            return response()->json();
        }
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = ResidenceArea::all();
            return response()->json($data);
        }
    }

    public function edit($id,ResidenceArea $residenceArea)
    {
        if (request()->ajax()) {
            $data = ResidenceArea::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, ResidenceArea $residenceArea)
    {
        $request->validate([
            'zona' => 'required',
            'cantidad' => 'required|integer'
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'zona' => $data['zona'],
                'cantidad' => $data['cantidad'],
            ]);
            ResidenceArea::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de area de residencia.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id,ResidenceArea $residenceArea)
    {
        if (request()->ajax()) {
            ResidenceArea::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de area de residencia.", auth()->user()->name);
            return response()->json();
        }
    }
}
