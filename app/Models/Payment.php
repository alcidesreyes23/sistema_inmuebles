<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function property_type_payments() {
        return $this->hasMany('App\Models\PropertyTaxPayment');
    }

    public function tax() {
        return $this->belongsTo('App\Models\Tax');
    }
}
