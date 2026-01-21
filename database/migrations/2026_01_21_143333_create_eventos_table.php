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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); // nullable es para que pueda ser nulo por defecto es como no nulo
            $table->string('name', 200); //nombre del evento
            $table->string('address', 80)->nullable(); //ubicacion, esta ubicacion puede ser nula
            $table->string('url')->nullable(); //la url puede ser nula
            $table->boolean('control')->default(false); // control de asistencia por defecto es false. si es true se puede controlar la asistencia
            $table->timestamps(); // esto da dos columnas created_at y updated_at
        });
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('ponencia')->nullable();
            $table->unsignedBigInteger('user_id'); // el unsignedBigInteger(cantidad de caracteres maximo es 20 digitos) es para que el id sea unico
            $table->unsignedTinyInteger('tipo_id'); //es para que el id sea unico y sea autoincremental
            $table->unsignedBigInteger('evento_id'); // el unsignedBigInteger(cantidad de caracteres maximo es 20 digitos) es para que el id sea unico
            $table->foreign('tipo_id')->references('id')->on('tipos'); //esta es la relacion con la tabla tipo con id de tipo aqui es foreign key si pongo foreignId no me deja crear la tabla dado que se define en el modelo
            $table->foreign('user_id')->references('id')->on('users'); // esta es la relacion con la tabla users con id de users
            $table->foreign('evento_id')->references('id')->on('eventos'); // esta es la relacion con la tabla eventos con id de eventos

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
        Schema::dropIfExists('eventos'); // no se elimina porque tiene datos
    }
};
