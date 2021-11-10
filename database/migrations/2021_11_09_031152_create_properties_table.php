<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ciudadano_id')->nullable();
            $table->unsignedBigInteger('colonia_id')->nullable();
            $table->unsignedBigInteger('tipo_inmueble_id')->nullable();
            $table->unsignedBigInteger('zona_residencia_id')->nullable();
            $table->string('numero_inmueble')->nullable();
            $table->float('ancho');
            $table->float('largo');
            $table->float('total');
            $table->string('pasaje')->nullable();;
            $table->string('calle')->nullable();;
            $table->foreign('ciudadano_id')->references('id')->on('citizens')->onDelete('set null');
            $table->foreign('colonia_id')->references('id')->on('suburbs')->onDelete('set null');
            $table->foreign('tipo_inmueble_id')->references('id')->on('property_types')->onDelete('set null');
            $table->foreign('zona_residencia_id')->references('id')->on('residence_areas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
