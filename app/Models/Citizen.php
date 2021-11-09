<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    public function properties(){
        return $this->hasMany('App\Models\Property');
    }

    protected $fillable = [
        'nombres',
        'apellidos', 
        'dui', 
        'nit',
        'fecha_nacimiento',
        'edad',
        'genero',
        'posee_inmueble'
    ];
}
