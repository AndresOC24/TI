<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registro_totales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->unique() // si deseas que haya un único registro por usuario
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->integer('total_tiempo')->default(0); // Podrías usar un 'int' o 'bigint' (en minutos)
            $table->integer('saldo')->default(0);       // Minutos a favor (positivo) o en contra (negativo)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registro_totales');
    }
};

