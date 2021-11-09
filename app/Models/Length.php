<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Length extends Model
{
    use HasFactory;

    public function properties(){
        return $this->hasOne('App\Models\Property');
    }
}
