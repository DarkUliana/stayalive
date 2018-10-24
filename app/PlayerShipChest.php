<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerShipChest extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'playerID', 'created_at', 'updated_at'
    ];

    public function items() {

        return $this->hasMany('App\PlayerShipChestItem', 'playerShipChestID', 'ID');
    }
}
