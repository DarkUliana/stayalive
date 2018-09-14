<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LootObject extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'created_at', 'updated_at'];

    protected $guarded = [];

    public function collection()
    {
        return $this->hasOne('App\LootCollection', 'ID', 'lootCollectionID');
    }
}
