<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerShipChestItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'googleID', 'playerShipChestID', 'created_at', 'updated_at'
    ];

    public function chest()
    {
        return $this->belongsTo('App\PlayerShipChest', 'playerShipChestID', 'ID');
    }
}
