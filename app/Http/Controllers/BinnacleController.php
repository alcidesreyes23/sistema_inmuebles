<?php

namespace App\Http\Controllers;

use App\Models\Binnacle;
use Illuminate\Http\Request;

class BinnacleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store($titulo,$descripcion,$username)
    {
        $binnacle = new Binnacle();
        $binnacle->titulo = $titulo;
        $binnacle->descripcion = $descripcion;
        $binnacle->username = $username;
        $binnacle->save();
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = Binnacle::all();
            return response()->json($data);
        }
    }

    public function edit(Binnacle $binnacle)
    {
        //
    }

    public function update(Request $request, Binnacle $binnacle)
    {
        //
    }

    public function destroy(Binnacle $binnacle)
    {
        //
    }
}
