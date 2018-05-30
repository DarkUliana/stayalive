<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AfterCraftItems extends Slot
{
    protected $table = 'after_craft_items';

    protected $primaryKey = 'ID';

    protected $guarded = [];
}
