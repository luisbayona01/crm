<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoomUser
 *
 * @property $id
 * @property $idroom
 * @property $iduser
 *
 * @property Room $room
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RoomUser extends Model
{

     protected $primaryKey = 'id';
    protected $table = 'room_user';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idroom','iduser'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function room()
    {
        return $this->hasOne('App\Models\Room', 'id', 'idroom');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'iduser');
    }


}
