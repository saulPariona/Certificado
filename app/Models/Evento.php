<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // relacion de muchos a muchos


class Evento extends Model
{
    protected $table = "eventos"; // eñ protected $table define la tabla que se va a usar
    protected $fillable = [
        'fecha',
        'name',
        'address',
        'url',
    ];
    protected $hidden = [
        'control', // control de asistencia esto se va a ocultar se va hacer mediante logica
    ];

    public function pre_registrados(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participantes', 'evento_id', 'user_id')->where('tipo_id', 1); // esto es para la relacion de muchos a muchos con la tabla participantes de eventos
        //participantes es la tabla intermedia
        //evento_id es la llave foranea de la tabla eventos
        //user_id es la llave foranea de la tabla users 
        //where('tipo_id', 1) es para que solo muestre los pre-registrados que esten en control 1 (1=pre-Registro, 2=Asistente, 3=Ponente, 4=Organizador)
    }
    public function asistentes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participantes', 'evento_id', 'user_id')->where('tipo_id', 2); // esto es para la relacion de muchos a muchos con la tabla participantes de eventos
        //participantes es la tabla intermedia
        //evento_id es la llave foranea de la tabla eventos
        //user_id es la llave foranea de la tabla users 
        //where('tipo_id', 2) es para que solo muestre los asistentes que esten en control 2 (1=pre-Registro, 2=Asistente, 3=Ponente, 4=Organizador)
    }
    public function ponentes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participantes', 'evento_id', 'user_id')->where('tipo_id', 3); // esto es para la relacion de muchos a muchos con la tabla participantes de eventos
        //participantes es la tabla intermedia
        //evento_id es la llave foranea de la tabla eventos
        //user_id es la llave foranea de la tabla users 
        //where('tipo_id', 3) es para que solo muestre los ponentes que esten en control 3 (1=pre-Registro, 2=Asistente, 3=Ponente, 4=Organizador)
    }
    public function organizadores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participantes', 'evento_id', 'user_id')->where('tipo_id', 4); // esto es para la relacion de muchos a muchos con la tabla participantes de eventos
        //participantes es la tabla intermedia
        //evento_id es la llave foranea de la tabla eventos
        //user_id es la llave foranea de la tabla users 
        //where('tipo_id', 4) es para que solo muestre los organizadores que esten en control 4 (1=pre-Registro, 2=Asistente, 3=Ponente, 4=Organizador)
    }
}
