<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'googleID'];

    protected $guarded = [];

}
