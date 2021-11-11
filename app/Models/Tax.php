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

    public function payments() {
        return $this->hasMany('App\Models\Payment');
    }

    public function subdivision_taxes() {
        return $this->hasMany('App\Models\SubdivisionTax');
    }
}
