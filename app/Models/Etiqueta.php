<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relación muchos a muchos con contacto
    public function contactos()
    {
        return $this->belongsToMany(Contacto::class)->withPivot('subetiqueta_id');
    }

    // Relación uno a muchos con subetiquetas
    public function subetiquetas()
    {
        return $this->hasMany(Subetiqueta::class);
    }

    // Contador de contactos
    public function getNumContactosAttribute()
    {
        return $this->contactos()->count();
    }
}