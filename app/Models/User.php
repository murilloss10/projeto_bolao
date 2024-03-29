<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Traits\HasPrimaryKeyUuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasPrimaryKeyUuid, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $keyType = 'string';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'type',
        'email',
        'cpf',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function apostas()
    {
        return $this->hasMany(Aposta::class, 'usuario_id', 'id');
    }
}
