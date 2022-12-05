<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('id_usuario'); 
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('id_paquete');
            $table->foreign('id_paquete')->references('id')->on('paquetes');
            $table->date('fecha_evento_inicio');
            $table->string('hora_evento_inicio');
            $table->string('hora_evento_fin');            
            $table->string('rechazado_por')->nullable();  
            $table->string('estado');
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
        Schema::dropIfExists('eventos');
    }
}
