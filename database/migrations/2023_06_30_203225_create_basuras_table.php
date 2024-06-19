<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basuras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');// organico, infeccioso, etc
            $table->float('precio_venta');// precio de venta de algunos residuos reciclables 
            $table->string('tipo');// tipo de basura 
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
        Schema::dropIfExists('basuras');
    }
};
