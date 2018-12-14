<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SceneEnemyItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];
}
