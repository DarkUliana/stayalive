<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobLoot extends Model
{
    protected $table = 'mob_loot';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'created_at', 'updated_at'];

    public function loot()
    {
        return $this->hasMany('App\MobLootItem', 'mobLootID', 'ID');
    }
}
