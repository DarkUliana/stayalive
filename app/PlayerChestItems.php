<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerChestItems extends Slot
{
    protected $primaryKey = 'ID';

    protected $table = 'player_chest_items';
}
