<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function citizen() {
        return $this->belongsTo('App\Models\Citizen');
    }

    public function length() {
        return $this->belongsTo('App\Models\Length');
    }

    public function suburb() {
        return $this->belongsTo('App\Models\Suburb');
    }

    public function residence_area() {
        return $this->belongsTo('App\Models\ResidenceArea');
    }

    public function property_type() {
        return $this->belongsTo('App\Models\PropertyType');
    }

    public function property_taxes() {
        return $this->hasMany('App\Models\PropertyTax');
    }
}
