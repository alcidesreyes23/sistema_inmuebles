<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidenceArea extends Model
{
    use HasFactory;

    public function properties(){
        return $this->hasMany('App\Models\Property');
    }
}
