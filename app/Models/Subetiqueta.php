<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subetiqueta extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'etiqueta_id'];

    public function etiqueta()
    {
        return $this->belongsTo(Etiqueta::class);
    }

    public function contactos()
    {
        return $this->belongsToMany(Contacto::class);
    }
}
