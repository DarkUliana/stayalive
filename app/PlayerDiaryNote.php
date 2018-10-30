<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerDiaryNote extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'playerID', 'created_at', 'updated_at'
    ];
}
