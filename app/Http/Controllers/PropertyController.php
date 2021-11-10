<?php

namespace App\Http\Controllers;

use App\Models\Property;
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
        return view("properties.index");
    }

    public function detalles($id)
    {
        return 'Hola Detalles';
    }


    public function cargarDetalle($id)
    {
        //listado
        //$data = Persona::orderBy('id', 'DESC')->get();
        /*
            select s.colonia, pt.tipo_inmueble, l.total, ra.zona, p.pasaje, p.calle
            from properties p
            INNER JOIN suburbs s on s.id = p.colonia_id
            INNER JOIN property_types pt on pt.id = p.tipo_inmueble_id
            INNER JOIN lengths l on l.id = p.longitud_id
            INNER JOIN residence_areas ra on ra.id = p.zona_residencia_id
            where p.ciudadano_id = 1
        */
        if (request()->ajax()) {
            $data = Property::where("ciudadano_id","=",$id)
            ->select('suburbs.colonia','property_types.tipo_inmueble','residence_areas.zona','properties.pasaje','properties.calle')
                        ->join('suburbs','suburbs.id','=','properties.colonia_id')
                        ->join('property_types','property_types.id','=','properties.tipo_inmueble_id')
                        ->join('residence_areas','residence_areas.id','=','properties.zona_residencia_id')
                    ->get();

            return response()->json($data);
        }
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
        //
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
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
