<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Property;
use App\Models\PropertyTax;
use App\Models\PropertyType;
use App\Models\Suburb;
use App\Models\Tax;
use Illuminate\Http\Request;
use App\Models\SubdivisionTax;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Citizen::All();
        return view("properties.index",compact('data'));
    }

    public function addTax($id)
    {

        //$data = PropertyTax::all();
        $data = PropertyTax::where("inmueble_id","=",$id)
        ->select('property_taxes.id','taxes.tributo','property_taxes.monto_fijo','property_taxes.monto_pagado','property_taxes.deuda_total',)
                    ->join('taxes','taxes.id','=','property_taxes.tributo_id')->get();

        $taxes = Tax::all();
        return view("properties.add-tax",compact('id','taxes','data'));
    }

    public function destroy2($id)
    {
        if (request()->ajax()) {
            PropertyTax::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de tributo en propiedad.", auth()->user()->name);
            return response()->json();
        }
    }

    public function detalles($id)
    {
        $tributos = Tax::all();
        $colonias = Suburb::all();
        $tipos = PropertyType::all();
        return View('properties.detalle',compact('id','colonias','tipos','tributos'));
    }


    public function cargarDetalle($id)
    {
        if (request()->ajax()) {
            $data = Property::where("ciudadano_id","=",$id)
            ->select('properties.id','suburbs.id as idColonia','suburbs.colonia','property_types.tipo_inmueble','properties.pasaje','properties.calle','properties.ancho','properties.largo','properties.total','properties.numero_inmueble')
                        ->join('suburbs','suburbs.id','=','properties.colonia_id')
                        ->join('property_types','property_types.id','=','properties.tipo_inmueble_id')
            ->get();

            return response()->json($data);
        }
    }

    public function create()
    {
        //
    }

    public function totalTaxt(Request $request)
    {
        if (request()->ajax()) {
            /*Captutamos campos necesarios y datos que se necesitan apra el calculo*/
            $sub_id = ($request->sub_id != null) ? $request->sub_id : 0;
            $tax_id = $request->tributo_id;
            $inmueble_id = $request->inmueble_id;
            $fecha = $request->mes;
            $numPagos = 12 - date('m', strtotime($fecha));
            $deuda = 0;
            $montoFijo = 0;

             /*Consultamos el costo que tiene el tax seleccionado*/
            $costoTax = Tax::select('taxes.costo')->where('taxes.id', '=', $tax_id)->get()->first()->costo;

            if ($sub_id != 0) {
                $costoTax = SubdivisionTax::select('subdivision_taxes.costo')->where('subdivision_taxes.id', '=', $sub_id)->get()->first()->costo;
            }

             /*Consultamos la longitud de nuestro inmueble*/
            $longitud = Property::select('properties.total')->where('properties.id', '=', $inmueble_id)->get()->first()->total;


            /*Calculamos deuda total apartir del mes de registro y costo fijo*/
            if($tax_id == 1)
            {
                $montoFijo =  sqrt($longitud) * $costoTax ;
                $deuda = sqrt($longitud) * $costoTax * $numPagos;
            }else if ($sub_id == 5)
            {
                $deuda = $costoTax;
                $montoFijo = $costoTax;
            }else{
                $deuda = $longitud * $costoTax * $numPagos;
                $montoFijo =  $longitud * $costoTax;
            }

            $newData = new PropertyTax();
            $newData->tributo_id = $request->tributo_id;
            $newData->inmueble_id = $request->inmueble_id;
            $newData->monto_fijo = $montoFijo;
            $newData->monto_pagado = 0;
            $newData->deuda_total = $deuda;
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de tributos a propiedad", auth()->user()->name);
            return response()->json();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'colonia' => 'required',
            'tipo' => 'required',
            'numero_inmueble' => 'required|numeric',
            'ancho' => 'required|numeric',
            'largo' => 'required|numeric',
            'pasaje' => 'required',
            'calle' => 'required'
        ]);

        if ($request->ajax()) {

            $newData = new Property();
            $newData->ciudadano_id = $request->idCiudadano;
            $newData->colonia_id = $request->colonia;
            $newData->tipo_inmueble_id = $request->tipo;
            $newData->numero_inmueble = $request->numero_inmueble;
            $newData->ancho = $request->ancho;
            $newData->largo = $request->largo;
            $newData->total = $request->ancho * $request->largo;
            $newData->pasaje = $request->pasaje;
            $newData->calle = $request->calle;

            $newData->save();


            /*Actulizando valor contado de Colonias y Tipos de Propiedades*/
            Suburb::where('id', $request->colonia)->increment('cantidad', 1);
            PropertyType::where('id', $request->tipo)->increment('cantidad', 1);


            /*Actualizando el campo para aquellos ciudadanos que no tenian propiedad en un Inicio*/
            Citizen::where('id', $request->idCiudadano)->update(array('posee_inmueble' => 'Si'));

            app(BinnacleController::class)->store("Insert", "Registro de nueva propiedad", auth()->user()->name);
            return response()->json();
        }
    }

    public function show(Property $property)
    {
        //
    }

    public function edit($id, Request $request)
    {
         //obtener los datos
         if (request()->ajax()) {
            $data = Property::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'numero_inmueble' => 'required|numeric',
            'ancho' => 'required|numeric',
            'largo' => 'required|numeric',
            'pasaje' => 'required',
            'calle' => 'required'
        ]);
        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'ciudadano_id' => $data['idCiudadano'],
                'numero_inmueble' => $data['numero_inmueble'],
                'ancho' => $data['ancho'],
                'largo' => $data['largo'],
                'total' => $data['ancho'] * $data['largo'],
                'pasaje' => $data['pasaje'],
                'calle' => $data['calle'],
            ]);

            Property::where('id', '=', $request->idPro)->update($array);

            app(BinnacleController::class)->store("Update", "Actualizacion de propiedad", auth()->user()->name);
            return response()->json($data);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //eliminar
         if (request()->ajax()) {
            Property::destroy($id);

            app(BinnacleController::class)->store("Delete", "Eliminación de propiedad", auth()->user()->name);
            return response()->json();
        }
    }
}
