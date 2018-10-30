<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerIdentificator extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    public function player()
    {
        return $this->belongsTo('App\Player', 'playerID', 'ID');
    }
}
