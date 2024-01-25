<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $idcategorias
 * @property $categoria
 *
 * @property Propiedad[] $propiedades
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    public $timestamps = false;
    protected $table = 'categorias';
    protected $primaryKey = 'id';

    protected $perPage = 30;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','categoria'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propiedades()
    {
        return $this->hasMany('App\Propiedad', 'categoria', 'id');
    }
    

}
