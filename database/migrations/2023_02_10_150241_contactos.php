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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('urlfotoperfil');
            $table->string('urlidentificacion');
            $table->string('ndi');
            $table->string('nombre');
            $table->string('correo');
            $table->string('telefono');
            $table->string('pais');
            $table->string('ciudad');
            $table->string('segurosocial');
            $table->string('profesion');
            $table->string('fechadecumpleanios');
            $table->string('status');
            $table->string('referencia');
            $table->string('etiqueta')->default('');
            $table->string('tipodeafiliacion');
            $table->string('fechadeafiliacionintreasso')->default('');
            $table->string('notasdeperfil');
            $table->string('notas');
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
        Schema::dropIfExists('contactos');
    }
};
