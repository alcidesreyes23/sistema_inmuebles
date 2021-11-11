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

    public function suburb() {
        return $this->belongsTo('App\Models\Suburb');
    }

    public function property_type() {
        return $this->belongsTo('App\Models\PropertyType');
    }

    public function property_tax_payment() {
        return $this->hasMany('App\Models\PropertyTaxPayment');
    }
}
