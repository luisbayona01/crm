<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model{
    use HasFactory;
    protected $guarded = [];

    // Relación muchos a muchos con contacto
    public function contactos(){
        return $this->belongsToMany(Contacto::class)->withPivot('evento_id');
    }
    // Relación uno a muchos con eventos
    public function eventos(){
        return $this->hasMany(Evento::class, 'userid');
    }
    // Contador de contactos
    public function getNumContactosAttribute(){
        return $this->contactos()->count();
    }
}