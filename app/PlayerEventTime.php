<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerEventTime extends Model
{
    protected $table = 'player_event_time';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'playerID', 'created_at', 'updated_at',
    ];
}
