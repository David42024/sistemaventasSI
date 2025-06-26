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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproducto');
            $table->string('descripcion',50);
            $table->unsignedBigInteger('idcategoria');
            $table->unsignedBigInteger('idunidad');
            $table->float('stock');
            $table->float('precio');
            $table->boolean('estado')->default(true);


            $table->foreign('idcategoria')->references('idcategoria')->on('categorias')->onDelete('cascade');
            $table->foreign('idunidad')->references('idunidad')->on('unidades');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
