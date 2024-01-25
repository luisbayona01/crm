<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Propiedad
 *
 * @property $id
 * @property $Titulo
 * @property $descripcion
 * @property $precio
 * @property $ciudad
 * @property $estado
 * @property $piscina
 * @property $galeriaImagenes
 * @property $urlvideo
 * @property $planosPiso
 * @property $direccion
 * @property $codigoPostal
 * @property $metroscuadradosconstruccion
 * @property $metroscuadradostotal
 * @property $banos
 * @property $habitaciones
 * @property $camarasTV
 * @property $garages
 * @property $parqueadero
 * @property $refrigeracion
 * @property $calefaccion
 * @property $seguridad
 * @property $anoconstruccion
 * @property $virtualtour
 * @property $contactonombre
 * @property $contactoemail
 * @property $contactotelefono
 * @property $categoria
 * @property $idusario
 *
 * @property Categoria $categoria
 * @property Ciudade $ciudade
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Propiedad extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'propiedad';
    /*static $rules = [
    'categoria' => 'required',
    ];*/

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'descripcion', 'precio', 'ciudad', 'estado', 'piscina', 'galeriaImagenes', 'urlvideo', 'planosPiso', 'direccion', 'codigoPostal', 'metroscuadradosconstruccion', 'metroscuadradostotal', 'banos', 'habitaciones', 'camarasTV', 'garages', 'parqueadero', 'refrigeracion', 'calefaccion', 'seguridad', 'anoconstruccion', 'virtualtour', 'contactonombre', 'contactoemail', 'contactotelefono', 'categoria_id', 'idusario'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ciudade()
    {
        return $this->hasOne('App\Models\Ciudade', 'id', 'ciudad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'idusario');
    }

}
