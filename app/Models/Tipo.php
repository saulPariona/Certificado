<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = "tipos";
    public $timestamps = false; // esto indica que no tiene las columnas created_at y updated_at
    protected $fillable = [ // el protected $fillable define los campos que se pueden llenar en el formulario 
        'tipo',
    ];
    protected $hidden = [ // el protected $hidden define los campos que no se muestran en el formulario
        'id',
    ];
}
