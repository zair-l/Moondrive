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
        Schema::create('alquileres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');
            $table->foreignId('propietario_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->decimal('monto_total', 8, 2);
            $table->string('estado')->default('pendiente'); // pendiente, aprobado, rechazado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquileres');
    }
};
