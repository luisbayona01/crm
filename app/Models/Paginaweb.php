<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paginaweb extends Model{
    protected $table = 'paginaswebs';
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class, 'userid');
    }
}