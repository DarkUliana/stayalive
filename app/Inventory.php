<?php

namespace App;


class Inventory extends Slot
{
    protected $table = 'inventory';

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'itemID');
    }

}
