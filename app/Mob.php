<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mob extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'created_at', 'updated_at'];

    public function enemy()
    {
        return $this->hasOne('App\Enemy', 'ID', 'enemyType');
    }
}
