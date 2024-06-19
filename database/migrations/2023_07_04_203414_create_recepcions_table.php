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
        Schema::create('recepcions', function (Blueprint $table) {
            $table->id();
            $table->datetime('fechaHora');
            $table->double('cantidad');
            $table->string('observacion');
            $table->unsignedBigInteger('id_basura');
            $table->unsignedBigInteger('id_recorrido')->nullable();
            $table->foreign('id_basura')->references('id')->on('basuras')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_recorrido')->references('id')->on('recorridos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('recepcions');
    }
};
