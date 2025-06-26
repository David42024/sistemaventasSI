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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('idcliente');
            $table->string('ruc_dni');
            $table->string('apellidos',80);
            $table->string('nombres',50);
            $table->string('email',100);
            $table->string('direccion',80);
            $table->boolean('estado')->default(true);;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
