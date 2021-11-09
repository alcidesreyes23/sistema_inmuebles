<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_type = new PropertyType();
        $property_type->tipo_inmueble = "Apartamento";
        $property_type->cantidad = 0;
        $property_type->save();

        $property_type1 = new PropertyType();
        $property_type1->tipo_inmueble = "Bodega";
        $property_type1->cantidad = 0;
        $property_type1->save();

        $property_type2 = new PropertyType();
        $property_type2->tipo_inmueble = "Casa";
        $property_type2->cantidad = 0;
        $property_type2->save();

        $property_type3 = new PropertyType();
        $property_type3->tipo_inmueble = "Casa en Condominio";
        $property_type3->cantidad = 0;
        $property_type3->save();

        $property_type4 = new PropertyType();
        $property_type4->tipo_inmueble = "Proyectos Habitacionales";
        $property_type4->cantidad = 0;
        $property_type4->save();

        $property_type5 = new PropertyType();
        $property_type5->tipo_inmueble = "Terreno";
        $property_type5->cantidad = 0;
        $property_type5->save();

        $property_type6 = new PropertyType();
        $property_type6->tipo_inmueble = "Terreno Comercial ";
        $property_type6->cantidad = 0;
        $property_type6->save();

        $property_type7 = new PropertyType();
        $property_type7->tipo_inmueble = "Construcción";
        $property_type7->cantidad = 0;
        $property_type7->save();

        $property_type8 = new PropertyType();
        $property_type8->tipo_inmueble = "Terrenos Urbanos";
        $property_type8->cantidad = 0;
        $property_type8->save();

    }
}
