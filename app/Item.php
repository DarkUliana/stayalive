<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $guarded = [];

    public function properties()
    {
        return $this->hasMany('App\ItemProperty', 'itemID', 'ID');
    }

    public function type()
    {
        return $this->hasOne('App\ItemType', 'type', 'InventorySlotType');
    }

    public function recipe()
    {
        return $this->hasOne('App\Recipe', 'ItemID', 'ID');
    }
}
