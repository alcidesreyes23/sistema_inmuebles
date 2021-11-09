<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tributo_id')->nullable();
            $table->unsignedBigInteger('inmueble_id')->nullable();
            $table->float('pago_fijo');
            $table->float('saldo');
            $table->float('deuda_total');
            $table->integer('anio');
            $table->foreign('tributo_id')->references('id')->on('taxes')->onDelete('set null');
            $table->foreign('inmueble_id')->references('id')->on('properties')->onDelete('set null');
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
        Schema::dropIfExists('property_taxes');
    }
}
