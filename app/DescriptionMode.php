<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptionMode extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    protected $guarded = [];
}
