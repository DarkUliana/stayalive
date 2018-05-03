<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $guarded = [];
}
