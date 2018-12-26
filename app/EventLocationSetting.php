<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLocationSetting extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'locationID', 'created_at', 'updated_at'];
}
