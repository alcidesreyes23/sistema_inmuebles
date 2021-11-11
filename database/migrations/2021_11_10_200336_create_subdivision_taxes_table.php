<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdivisionTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('subdivision_taxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tributo_id')->nullable();
            $table->text('nombre_subdivision');
            $table->float('costo');
            $table->foreign('tributo_id')->references('id')->on('taxes')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subdivision_taxes');
    }
}
