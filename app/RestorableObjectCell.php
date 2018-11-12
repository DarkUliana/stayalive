<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestorableObjectCell extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'restorableObjectID', 'created_at', 'updated_at'
    ];
}
