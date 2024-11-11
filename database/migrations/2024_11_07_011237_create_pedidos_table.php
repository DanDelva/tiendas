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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('isbn',15);
            $table->string('title', 50);
            $table->date('Fecha_Pedido');
            $table->date('Fecha_Envio');
            $table->string('Metodo_Pago', 50);
            $table->string('description',250);
            $table->decimal('total',10 , 2);
            $table->string('image',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
