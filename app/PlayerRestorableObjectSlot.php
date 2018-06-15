<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerRestorableObjectSlot extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'restorableObjectID', 'created_at', 'updated_at'];

    protected $guarded = [];
}
