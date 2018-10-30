<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerTraveledIsland extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'ID', 'playerID'
    ];
}
