<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->after('image'); // Agrega el campo price
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('price'); // Elimina el campo price si se revierte la migración
        });
    }
};
