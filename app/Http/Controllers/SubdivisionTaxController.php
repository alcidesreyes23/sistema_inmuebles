<?php

namespace App\Http\Controllers;

use App\Models\SubdivisionTax;
use Illuminate\Http\Request;

class SubdivisionTaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = SubdivisionTax::select('subdivision_taxes.id','subdivision_taxes.nombre_subdivision','subdivision_taxes.costo','taxes.tributo')
                ->join('taxes', 'taxes.id', '=', 'subdivision_taxes.tributo_id')
                ->get();
        return view('subdivision-tax.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_subdivision' => 'required',
            'costo' => 'required|numeric',
            'tributo_id' => 'required'
        ]);

        if ($request->ajax()) {
            SubdivisionTax::create($request->all());
            app(BinnacleController::class)->store("Insert", "Registro de nueva subdivision de tributo.", auth()->user()->name);
            return response()->json();
        }
    }

    public function show(SubdivisionTax $subdivisionTax)
    {
        if (request()->ajax()) {
            $data = SubdivisionTax::select('subdivision_taxes.id','subdivision_taxes.nombre_subdivision','subdivision_taxes.costo','taxes.tributo')
                ->join('taxes', 'taxes.id', '=', 'subdivision_taxes.tributo_id')
                ->get();
            return response()->json($data);
        }
    }

    public function edit($id,SubdivisionTax $subdivisionTax)
    {
        if (request()->ajax()) {
            $data = SubdivisionTax::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, SubdivisionTax $subdivisionTax)
    {
        $request->validate([
            'nombre_subdivision' => 'required',
            'costo' => 'required|numeric',
            'tributo_id' => 'required'
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'nombre_subdivision' => $data['nombre_subdivision'],
                'costo' => $data['costo'],
                'tributo_id' => $data['tributo_id']
            ]);
            SubdivisionTax::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de subdivision de tributo.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id,SubdivisionTax $subdivisionTax)
    {
        if (request()->ajax()) {
            SubdivisionTax::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de subdivision de tributo.", auth()->user()->name);
            return response()->json();
        }
    }
}
