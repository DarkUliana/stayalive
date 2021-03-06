<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloorRecover extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'created_at', 'updated_at'];
}
