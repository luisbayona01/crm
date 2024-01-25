<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use HasApiTokens;
    protected $guarded = [];

    public function eventos(){
        return $this->hasMany(Evento::class, 'userid');
    }
    public function paginaweb(){
        return $this->hasOne(Paginaweb::class, 'userid');
    }
}
