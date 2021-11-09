<?php

namespace Database\Seeders;

use App\Models\TaxType;
use Illuminate\Database\Seeder;

class TaxTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax_type = new TaxType();
        $tax_type->tipo_tributo = "Impuestos";
        $tax_type->save();

        $tax_type1 = new TaxType();
        $tax_type1->tipo_tributo = "Tasas municipales";
        $tax_type1->save();

        $tax_type2 = new TaxType();
        $tax_type2->tipo_tributo = "Contribuciones especiales";
        $tax_type2->save();
    }
}
