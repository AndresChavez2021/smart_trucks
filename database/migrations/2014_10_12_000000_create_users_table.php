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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidos')->nullable();
            $table->text('image')->nullable();
            $table->string('carpeta')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('ci')->unique()->nullable();
            $table->char('sexo')->nullable();
            $table->integer('phone')->unique()->nullable();
            $table->string('domicilio')->nullable();
            $table->smallInteger('estado')->nullable();

            //VECINO
            $table->double('latitud')->nullable();
            $table->double('longitud')->nullable();
            $table->unsignedBigInteger('id_ruta')->nullable(); //Ruta a la que pertenece
            $table->unsignedBigInteger('id_barrio')->nullable(); //nuevo campo
            $table->foreign('id_barrio')->references('id')->on('barrios')->onDelete('cascade')->onUpdate('cascade');//nueva llave foranea
            //PERSONAL
            $table->string('licencia')->nullable();
            $table->string('cargo')->nullable();
            $table->unsignedMediumInteger('sueldo')->nullable();
            $table->string('descripcion')->nullable();
            $table->smallInteger('tipoc');
            $table->smallInteger('tipoe');
            $table->foreign('id_ruta')->references('id')->on('rutas')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
