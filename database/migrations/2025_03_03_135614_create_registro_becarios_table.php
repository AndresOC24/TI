<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registro_becarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->unique() // si deseas un único registro por becario
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->integer('horas_total')->default(0); // Podrías usar 'int' o 'bigint'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registro_becarios');
    }
};
