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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->unsignedBigInteger('marca_id')->after('id');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->dropColumn('marca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->string('marca');
            $table->dropForeign(['marca_id']);
            $table->dropColumn('marca_id');
        });
    }
};
