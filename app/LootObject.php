<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootObject extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['created_at', 'updated_at'];

    protected $guarded = [];

    public function collections()
    {
        return $this->hasMany('App\LootObjectCollection', 'lootObjectID', 'ID');
    }
}
