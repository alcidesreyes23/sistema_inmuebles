<?php

namespace Database\Seeders;

use App\Models\SubdivisionTax;
use Illuminate\Database\Seeder;

class SubdivisionTaxSeeder extends Seeder
{
    public function run()
    {
        $subdivion_tax = new SubdivisionTax();
        $subdivion_tax->tributo_id = 2;
        $subdivion_tax->nombre_subdivision = "En fábricas industriales, o transformadoras de materia prima y supermercados";
        $subdivion_tax->costo = 0.12;
        $subdivion_tax->save();

        $subdivion_tax1 = new SubdivisionTax();
        $subdivion_tax1->tributo_id = 2;
        $subdivion_tax1->nombre_subdivision = "En zonas comerciales y de servicios";
        $subdivion_tax1->costo = 0.10;
        $subdivion_tax1->save();

        $subdivion_tax2 = new SubdivisionTax();
        $subdivion_tax2->tributo_id = 2;
        $subdivion_tax2->nombre_subdivision = "En Centros Educativos y de Enseñanza Superior, zonas de parqueo o bodegas y casas habitacionales";
        $subdivion_tax2->costo = 0.03;
        $subdivion_tax2->save();

        $subdivion_tax3 = new SubdivisionTax();
        $subdivion_tax3->tributo_id = 2;
        $subdivion_tax3->nombre_subdivision = "Barrido vial, vehicular o peatonal, por metro cuadrado de área barrida";
        $subdivion_tax3->costo = 0.03;
        $subdivion_tax3->save();

        $subdivion_tax4 = new SubdivisionTax();
        $subdivion_tax4->tributo_id = 4;
        $subdivion_tax4->nombre_subdivision = "Limpieza de predios baldíos particulares y aceras, por cuenta de la Alcaldía";
        $subdivion_tax4->costo = 46.30;
        $subdivion_tax4->save();

        $subdivion_tax5 = new SubdivisionTax();
        $subdivion_tax5->tributo_id = 4;
        $subdivion_tax5->nombre_subdivision = "Por predios o lotes baldíos aunque estuvieren cercados.";
        $subdivion_tax5->costo = 0.01;
        $subdivion_tax5->save();

        $subdivion_tax6 = new SubdivisionTax();
        $subdivion_tax6->tributo_id = 4;
        $subdivion_tax6->nombre_subdivision = "Servicio de Saneamiento Ambiental en inmuebles, destinados para comercio, industria y viviendas";
        $subdivion_tax6->costo = 0.01;
        $subdivion_tax6->save();
    }
}
