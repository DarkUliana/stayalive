<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerBody extends Model
{
    protected $table = 'players_bodies';

    protected $primaryKey = 'ID';

    protected $guarded = [];
}
