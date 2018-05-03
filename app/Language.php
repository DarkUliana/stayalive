<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $guarded = [];
    
}
