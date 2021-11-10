<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Tax::select('taxes.id', 'taxes.tributo', 'taxes.costo', 'tax_types.tipo_tributo')
                ->join('tax_types', 'tax_types.id', '=', 'taxes.taxtype_id')
                ->get();
        return view('tax.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'tributo' => 'required',
            'costo' => 'required|numeric',
            'taxtype_id' => 'required'
        ]);

        if ($request->ajax()) {
            $newData = new Tax();
            $newData->tributo = $request->tributo;
            $newData->costo = $request->costo;
            $newData->taxtype_id = $request->taxtype_id;
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo tributo.", auth()->user()->name);
            return response()->json();
        }
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = Tax::select('taxes.id', 'taxes.tributo', 'taxes.costo', 'tax_types.tipo_tributo')
                ->join('tax_types', 'tax_types.id', '=', 'taxes.taxtype_id')
                ->get();
            return response()->json($data);
        }
    }

    public function edit($id, Tax $tax)
    {
        if (request()->ajax()) {
            $data = Tax::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'tributo' => 'required',
            'costo' => 'required|numeric',
            'taxtype_id' => 'required'
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'tributo' => $data['tributo'],
                'costo' => $data['costo'],
                'taxtype_id' => $data['taxtype_id']
            ]);
            Tax::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de tributo.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id, Tax $tax)
    {
        if (request()->ajax()) {
            Tax::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de tributo.", auth()->user()->name);
            return response()->json();
        }
    }
}
