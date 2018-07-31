<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanList extends Model
{
    protected $table = 'ban_list';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function player()
    {
        return $this->hasOne('App\Player', 'googleID', 'googleID');
    }
}
