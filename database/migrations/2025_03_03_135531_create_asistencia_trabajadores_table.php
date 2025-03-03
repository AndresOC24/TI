<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('asistencia_trabajadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->date('fecha');
            $table->time('ingreso');
            $table->time('salida')->nullable(); // En caso de que se registre más tarde
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencia_trabajadores');
    }
};

