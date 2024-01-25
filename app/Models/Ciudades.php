<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ciudade
 *
 * @property $id
 * @property $nombre
 * @property $region
 *

 * @property Propiedad[] $propiedad
 * @property Region $region
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ciudades extends Model
{

     public $timestamps = false;
    protected $table = 'ciudades';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','region'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function localidads()
    {
        return $this->hasMany('App\Models\Localidad', 'ciudad', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propiedads()
    {
        return $this->hasMany('App\Models\Propiedad', 'ciudad', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /*public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region');
    }*/


}
