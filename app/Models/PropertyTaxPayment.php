<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTaxPayment extends Model
{
    use HasFactory;

    public function payment() {
        return $this->belongsTo('App\Models\Payment');
    }

    public function property_tax() {
        return $this->belongsTo('App\Models\PropertyTax');
    }
}
