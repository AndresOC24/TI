<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('horario_regulares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->time('ingreso');
            $table->time('salida');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horario_regulares');
    }
};
