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
        Schema::create('publicacions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userid')->default('.');
            $table->string('urlimagen')->default('.');
            $table->string('titulo')->default('.');
            $table->string('descripcion')->default('.');
            $table->string('pais')->default('.');
            $table->string('ubicacion')->default('.');
            $table->string('precio')->default('.');
            $table->string('comision')->default('.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacions');
    }
};
