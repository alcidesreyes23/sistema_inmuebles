<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTaxPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_tax_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('pago_id')->nullable();
            $table->unsignedBigInteger('inmueble_id')->nullable();
            $table->string('mes');
            $table->integer('anio');
            $table->foreign('pago_id')->references('id')->on('payments')->onDelete('set null');
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
        Schema::dropIfExists('property_tax_payments');
    }
}
