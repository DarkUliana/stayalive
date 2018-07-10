<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobLootItem extends Model
{
    protected $table = 'mob_loot_items';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'mobLootID', 'created_at', 'updated_at'];
}
