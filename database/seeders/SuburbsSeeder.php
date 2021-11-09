<?php

namespace Database\Seeders;

use App\Models\Suburb;
use Illuminate\Database\Seeder;

class SuburbsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suburbs = new Suburb();
        $suburbs->colonia = "El Espino ";
        $suburbs->cantidad = 0;
        $suburbs->save();

        $suburbs1 = new Suburb();
        $suburbs1->colonia = "La Ceiba";
        $suburbs1->cantidad = 0;
        $suburbs1->save();

        $suburbs2 = new Suburb();
        $suburbs2->colonia = "La Labranza ";
        $suburbs2->cantidad = 0;
        $suburbs2->save();

        $suburbs3 = new Suburb();
        $suburbs3->colonia = "La Puerta de la Laguna";
        $suburbs3->cantidad = 0;
        $suburbs3->save();

        $suburbs4 = new Suburb();
        $suburbs4->colonia = "Santa Elena ";
        $suburbs4->cantidad = 0;
        $suburbs4->save();

        $suburbs5 = new Suburb();
        $suburbs5->colonia = "Soledad";
        $suburbs5->cantidad = 0;
        $suburbs5->save();
    }
}
