<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestorableObjectSlot extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'restorableObjectID', 'created_at', 'updated_at'];

    protected $guarded = [];
}
