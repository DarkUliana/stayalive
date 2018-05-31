<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function descriptions()
    {
        return $this->hasMany('App\DialogDescription', 'dialogID', 'ID');
    }

    public function quest()
    {
        return $this->hasOne('App\Quest', 'ID', 'questID');
    }
}
