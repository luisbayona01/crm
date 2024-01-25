<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paginaswebs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('urlportada')->default('.');
            $table->string('urllogo')->default('.');
            $table->string('urlimagen1')->default('.');
            $table->string('urlimagen2')->default('.');
            $table->string('userid')->default('.');
            $table->string('titulo')->default('.');
            $table->string('slogan')->default('.');
            $table->string('quienessomos')->default('.');
            $table->string('mision')->default('.');
            $table->string('vision')->default('.');
            $table->string('iformacion')->default('.');
            $table->string('informaciondelequipo')->default('.');
            $table->string('tituloservicio1')->default('.');
            $table->string('tituloservicio2')->default('.');
            $table->string('tituloservicio3')->default('.');
            $table->string('descripcionservicio1')->default('.');
            $table->string('descripcionservicio2')->default('.');
            $table->string('descripcionservicio3')->default('.');
            $table->string('urlfacebook')->default('.');
            $table->string('urlinstagram')->default('.');
            $table->string('correo')->default('.');
            $table->string('telefono')->default('.');
            $table->string('direccion')->default('.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paginaswebs');
    }
};
