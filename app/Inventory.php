<?php

namespace App;


class Inventory extends Slot
{
    protected $table = 'inventory';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'itemID');
    }

}
