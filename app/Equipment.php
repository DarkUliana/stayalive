<?php

namespace App;


class Equipment extends Slot
{
    protected $table = 'equipment';

    protected $primaryKey = 'ID';

    protected $guarded = [];
}
