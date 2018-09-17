<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootCollectionItem extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'lootCollectionID', 'created_at', 'updated_at'];

    protected $guarded = [];
}
