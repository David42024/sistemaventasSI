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
        Schema::create('cabecera_ventas', function (Blueprint $table) {
            $table->id('idventa');
            $table->unsignedBigInteger('idcliente');
            $table->date('fechaventa');
            $table->unsignedBigInteger('idtipo');
            $table->float('total');
            $table->string('nrodoc',12);
            $table->float('subtotal');
            $table->float('igv');
            $table->boolean('estado')->default(true);

            $table->foreign('idtipo')->references('idtipo')->on('tipos');
            $table->foreign('idcliente')->references('idcliente')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabecera_ventas');
    }
};
