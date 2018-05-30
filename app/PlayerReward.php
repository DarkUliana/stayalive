<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerReward extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'googleID', 'created_at', 'updated_at'];

}
