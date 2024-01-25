<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $guarded = [];

    // ETIQUETAS
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }

    public function subetiquetas()
    {
        return $this->belongsToMany(Subetiqueta::class);
    }
    public function getSubetiquetasAttribute()
    {
        return $this->etiquetas->flatMap(function ($etiqueta) {
            return $etiqueta->subetiquetas;
        })->unique();
    }
    // EVENTOS
    public function eventos(){
        return $this->belongsToMany(Evento::class);
    }
}
