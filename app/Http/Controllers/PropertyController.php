<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\ResidenceArea;
use App\Models\Suburb;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Citizen::All();
        return view("properties.index",compact('data'));
    }

    public function detalles($id)
    {
        $colonias = Suburb::all();
        $tipos = PropertyType::all();
        $zonas = ResidenceArea::all();
        return View('properties.detalle',compact('id','colonias','tipos','zonas'));
    }


    public function cargarDetalle($id)
    {
        if (request()->ajax()) {
            $data = Property::where("ciudadano_id","=",$id)
            ->select('properties.id','suburbs.id as idColonia','suburbs.colonia','property_types.tipo_inmueble','residence_areas.zona','properties.pasaje','properties.calle','properties.ancho','properties.largo','properties.total')
                        ->join('suburbs','suburbs.id','=','properties.colonia_id')
                        ->join('property_types','property_types.id','=','properties.tipo_inmueble_id')
                        ->join('residence_areas','residence_areas.id','=','properties.zona_residencia_id')
                    ->get();

            return response()->json($data);
        }
    }

    public function propiedades()
    {
        $data = Property::select('properties.id as id','properties.numero_inmueble as num','properties.calle as calle',
        'citizens.nombres as nombres','citizens.apellidos as apellidos','citizens.dui as dui','citizens.nit as nit')
                ->join('citizens','citizens.id','=','properties.ciudadano_id')
                ->get();

        return view("pagos.index",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $newData = new Property();
            $newData->ciudadano_id = $request->idCiudadano;
            $newData->colonia_id = $request->colonia;
            $newData->tipo_inmueble_id = $request->tipo;
            $newData->zona_residencia_id = $request->zona;
            $newData->numero_inmueble = $request->num;
            $newData->ancho = $request->ancho;
            $newData->largo = $request->largo;
            $newData->total = $request->ancho * $request->largo;
            $newData->pasaje = $request->pasaje;
            $newData->calle = $request->calle;

            $newData->save();
            /*Actualizando el campo para aquellos ciudadanos que no tenian propiedad en un Inicio*/
            Citizen::where('id', $request->idCiudadano)->update(array('posee_inmueble' => 'Si'));

            app(BinnacleController::class)->store("Insert", "Registro de nueva propiedad", auth()->user()->name);
            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
         //obtener los datos
         if (request()->ajax()) {
            $data = Property::findOrFail($id);
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'ciudadano_id' => $data['idCiudadano'],
                'colonia_id' => $data['colonia'],
                'tipo_inmueble_id' => $data['tipo'],
                'zona_residencia_id' => $data['zona'],
                'numero_inmueble' => $data['num'],
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
