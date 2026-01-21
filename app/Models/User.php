<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Contracts\OAuthenticatable;

class User extends Authenticatable implements OAuthenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    //no exite el create ni el update en la base de datos
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ // el protected $fillable define los campos que se pueden llenar en el formulario
        'name',
        'paternal_surname',
        'maternal_surname',
        'email',
        'password',
        'dni',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [ // el protected $hidden define los campos que no se muestran en el formulario
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // el protected $casts define los tipos de datos de los campos
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // el password es de tipo hashed es para que el password sea encriptado
        ];
    }
}
