<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipStuff extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'created_at', 'updated_at'];

    public function defaultItems()
    {
        return $this->hasMany('App\ShipStuffItem', 'stuffID', 'ID');
    }

    public function items()
    {
        return $this->hasMany('App\PlayerShipStuffItem', 'stuffID', 'ID');
    }
}
