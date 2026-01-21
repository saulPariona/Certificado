<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->uuid('id')->primary(); // el uuid es para que el id sea unico
            $table->unsignedTinyInteger('tipo_id'); // el unsignedBigInteger(cantidad de caracteres maximo es 255) es para que el id sea unico
            $table->foreign('tipo_id')->references('id')->on('tipos'); // esta es la relacion con la tabla tipos con id de tipos
            $table->unsignedBigInteger('user_id'); // el unsignedBigInteger(cantidad de caracteres maximo es 20 digitos) es para que el id sea unico
            $table->foreign('user_id')->references('id')->on('users'); // esta es la relacion con la tabla users con id de users
            $table->unsignedBigInteger('evento_id'); // el unsignedBigInteger(cantidad de caracteres maximo es 20 digitos) es para que el id sea unico
            $table->foreign('evento_id')->references('id')->on('eventos'); // esta es la relacion con la tabla eventos con id de eventos
            $table->timestamps(); // esto da dos columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
