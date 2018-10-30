<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerBodyPosition extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'playerID', 'sceneName', 'created_at', 'updated_at'];
}
