<?php

namespace Database\Seeders;

use App\Models\ResidenceArea;
use Illuminate\Database\Seeder;

class ResidenceAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $residence_area = new ResidenceArea();
        $residence_area->zona = "En fábricas industriales, o transformadoras de materia prima y supermercados";
        $residence_area->cantidad = 0;
        $residence_area->save();

        $residence_area1 = new ResidenceArea();
        $residence_area1->zona = "En zonas comerciales y de servicios";
        $residence_area1->cantidad = 0;
        $residence_area1->save();

        $residence_area2 = new ResidenceArea();
        $residence_area2->zona = "En Centros Educativos y de Enseñanza Superior, zonas de parqueo o bodegas y casas habitacionales";
        $residence_area2->cantidad = 0;
        $residence_area2->save();

        $residence_area3 = new ResidenceArea();
        $residence_area3->zona = "Barrido vial, vehicular o peatonal, por metro cuadrado de área barrida";
        $residence_area3->cantidad = 0;
        $residence_area3->save();
    }
}
