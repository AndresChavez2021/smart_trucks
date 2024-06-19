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
        Schema::create('recoleccions', function (Blueprint $table) {
            $table->id();
            $table->datetime('fechaHora'); 
            $table->float('peso');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_categoria')->references('id')->on('categorias_reciclables')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('recoleccions');
    }
};
