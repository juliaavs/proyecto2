<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario (puede ser null)
            $table->unsignedBigInteger('user_id')->nullable();

            // Estado del pedido
            $table->string('status')->default('pending');

            // Código de promoción aplicado (opcional)
            $table->string('promo_code')->nullable();

            // Dirección de envío
            $table->string('street');
            $table->string('number')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('zip_code');
            $table->string('country');

            $table->timestamps();

            // Clave foránea al usuario
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
