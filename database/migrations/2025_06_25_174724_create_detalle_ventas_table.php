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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->unsignedBigInteger('idventa');
            $table->unsignedBigInteger('idproducto');
            $table->float('precio');
            $table->float('cantidad');

            $table->primary(['idventa','idproducto']);
            $table->foreign('idventa')->references('idventa')->on('cabecera_ventas');
            $table->foreign('idproducto')->references('idproducto')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
