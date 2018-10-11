<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipStuffItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'stuffID', 'created_at', 'updated_at'
    ];
}
