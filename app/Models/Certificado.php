<?php

namespace App\Models;
//cada modelo puede trabajar con diferentes tipos de base de datos pero se tiene que especificar el tipo de base de datos
use Illuminate\Database\Eloquent\Concerns\HasUuids; // para que el id sea unico y es primary key
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificado extends Model

{
    use HasUuids; // para que el id sea unico y es primary key

    protected $table = 'certificados';
    public $incrementing = false; // es para que no sea autoincremental
    protected $fillable = [ // el protected $fillable define los campos que se pueden llenar en el formulario 
        'tipo_id',
        'user_id',
        'evento_id',
    ];
    protected $hidden = []; // el protected $hidden define los campos que no se muestran en el formulario
    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Tipo::class, 'tipo_id'); // el belongsTo es una funcion que relaciona a un solo modelo
    }
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class, 'evento_id'); // el belongsTo es una funcion que relaciona a un solo modelo
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); // el belongsTo es una funcion que relaciona a un solo modelo
    }
}
