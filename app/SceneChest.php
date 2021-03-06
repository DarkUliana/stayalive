<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SceneChest extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];
}
