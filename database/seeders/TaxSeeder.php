<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = new Tax();
        $tax->taxtype_id = 2;
        $tax->tributo = "Alumbrado";
        $tax->costo = 0.35;
        $tax->save();

        $tax1 = new Tax();
        $tax1->taxtype_id = 2;
        $tax1->tributo = "Aseo público";
        $tax1->costo = 0;
        $tax1->save();

        $tax2 = new Tax();
        $tax2->taxtype_id = 2;
        $tax2->tributo = "Pavimentación asfáltica, de concreto adoquinado";
        $tax2->costo = 0.11;
        $tax2->save();

        $tax3 = new Tax();
        $tax3->taxtype_id = 2;
        $tax3->tributo = "Ornato y saneamiento";
        $tax3->costo = 0.01;
        $tax3->save();
    }
}
