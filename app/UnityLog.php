<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnityLog extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'playerID'];

    protected $guarded = [];

}
