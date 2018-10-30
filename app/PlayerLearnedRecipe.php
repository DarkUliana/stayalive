<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerLearnedRecipe extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'playerID', 'created_at', 'updated_at'
    ];
}
