<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID'];
}
