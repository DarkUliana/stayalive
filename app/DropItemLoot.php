<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropItemLoot extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'dropItemID', 'created_at', 'updated_at'
    ];
}
