<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    public function loot()
    {
        return $this->hasMany('App\DropItemLoot', 'dropItemID', 'ID');
    }
}
