<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pai
 *
 * @property $id
 * @property $pais
 *
 * @property Region[] $regions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pais extends Model
{
     public $timestamps = false;
    protected $table = 'pais';
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pais'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany('App\Region', 'pais', 'id');
    }


}
