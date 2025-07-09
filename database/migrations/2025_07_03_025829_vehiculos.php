<?php

use Illuminate\Database\Eloquent\Attributes\Scope;
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
        Schema::create('vehiculos', function(Blueprint $table){
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->year('anio');
            $table->string('tipo');
            $table->string('placa')->unique();
            $table->string('precio',8,2);
            $table->string('transmision');
            $table->string('pasajeres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
