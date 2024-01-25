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
        Schema::create('gruposfacebooks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('urlgrupo')->default('.');
            $table->string('nombre')->default('.');
            $table->string('pais')->default('.');
            $table->string('cantidadmiembros')->default('.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gruposfacebooks');
    }
};
