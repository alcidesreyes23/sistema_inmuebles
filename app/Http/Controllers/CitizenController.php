<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Binnacle;
use App\Models\Property;
use App\Models\PropertyTax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitizenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("citizens.index");
    }

    public function cargarDatos()
    {
        //listado
        //$data = Persona::orderBy('id', 'DESC')->get();
        if (request()->ajax()) {
            $data = Citizen::all();
            return response()->json($data);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'edad' => 'required',
            'fecha_nacimiento' => 'required',
            'dui' => 'required|unique:citizens',
            'nit' => 'required|unique:citizens',
            'posee_inmueble' => 'required',
        ]);

        Citizen::create($request->all());
        app(BinnacleController::class)->store("Insert", "Registro de nuevo Ciudadano", auth()->user()->name);
        if ($request->posee_inmueble == 'Si') {
            $lastId = Citizen::latest('id')->first();
            return redirect()->route('properties.index2', $lastId);
        }
        return redirect()->route('citizens.index');
    }

    public function solvencia($id)
    {
        $ciudadano = Citizen::findOrFail($id);
        if ($ciudadano->posee_inmueble == 'Si') {
            $inmuebles = Property::where('ciudadano_id', $id)->select('*')->get();
            $tributos = [];
            foreach ($inmuebles as $key => $value) {
                $tributo = DB::select('select  pt.inmueble_id, pt.tributo_id, pt.monto_fijo,pt.monto_pagado,pt.deuda_total,pt.created_at,tax.tributo from property_taxes pt
                                        inner join taxes tax on tax.id = pt.tributo_id where pt.inmueble_id = ?', [$value->id]);
                foreach ($tributo as $key => $tri) {
                    $fecha_creacion = PropertyTax::select('created_at')->where('tributo_id', '=', $tri->tributo_id)->where('inmueble_id', '=', $value->id)->get()->first()->created_at;
                    $monto_fijo = PropertyTax::select('monto_fijo')->where('tributo_id', '=', $tri->tributo_id)->where('inmueble_id', '=', $value->id)->get()->first()->monto_fijo;
                    $monto_pagado = PropertyTax::select('monto_pagado')->where('tributo_id', '=', $tri->tributo_id)->where('inmueble_id', '=', $value->id)->get()->first()->monto_pagado;
                    $deuda_total = PropertyTax::select('deuda_total')->where('tributo_id', '=', $tri->tributo_id)->where('inmueble_id', '=', $value->id)->get()->first()->deuda_total;
                    $meses = 13 - date('m', strtotime($fecha_creacion));
                    $mes_actual = date('m');
                    $meses_pago = 13 - $mes_actual;
                    $meses_esperado = $meses - $meses_pago;
                    $pago_esperado = $monto_fijo * $meses_esperado;

                    if ($pago_esperado == $monto_pagado) {
                        $estado = "EN LINEA";
                    } else {
                        $estado = "MOROSO";
                    }

                    if ($meses_esperado == 0) {
                        $rango_f = 'NO FACTURADO';
                        $deuda = 0;
                    } else {
                        $rango_f = date('F', strtotime($fecha_creacion)) . ' to ' . date('F', strtotime('2021-' . ($mes_actual - 1)));
                        $deuda = $pago_esperado - $monto_fijo;
                    }

                    $data2 = [
                        'inmueble_id' => $tri->inmueble_id,
                        'tributo' => $tri->tributo,
                        'rango' => $rango_f,
                        'pago' => number_format($monto_fijo, 2),
                        'monto_pagado' => number_format($monto_pagado, 2),
                        'monto_esperado' => number_format($pago_esperado, 2),
                        'deuda' => number_format($deuda, 2),
                        'deuda_total' => number_format($deuda_total, 2),
                        'estado' => $estado
                    ];
                    array_push($tributos,$data2);
                }
            }
        } else {
            $inmuebles = null;
            $tributos = null;
        }
        return view('solvency.index', compact('id', 'ciudadano', 'inmuebles', 'tributos'));
    }

    public function show(Citizen $citizen)
    {
        //
    }

    public function edit($id, Request $request)
    {
        //obtener los datos
        if (request()->ajax()) {
            $data = Citizen::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'edad' => 'required',
            'fecha_nacimiento' => 'required',
            'dui' => 'required',
            'nit' => 'required',
            'posee_inmueble' => 'required',
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'edad' => $data['edad'],
                'genero' => $data['genero'],
                'dui' => $data['dui'],
                'nit' => $data['nit'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'posee_inmueble' => $data['posee_inmueble'],
            ]);
            Citizen::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de Ciudadano", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        //eliminar
        if (request()->ajax()) {
            Citizen::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminacion de Ciudadano", auth()->user()->name);
            return response()->json();
        }
    }
}
