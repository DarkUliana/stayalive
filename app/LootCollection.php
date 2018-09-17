<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootCollection extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'name', 'created_at', 'updated_at'];

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\LootCollectionItem', 'lootCollectionID', 'ID');
    }
}
