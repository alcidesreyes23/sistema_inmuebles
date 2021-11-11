<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Suburb;
use App\Models\Tax;
use Illuminate\Http\Request;

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
