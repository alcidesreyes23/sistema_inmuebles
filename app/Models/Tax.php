<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    public function tax_type() {
        return $this->belongsTo('App\Models\TaxType');
    }

    public function property_taxes() {
        return $this->hasMany('App\Models\PropertyTax');
    }
}
