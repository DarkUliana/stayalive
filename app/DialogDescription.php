<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DialogDescription extends Model
{
    public function description()
    {
        return $this->hasOne('App\Description', 'ID', 'descriptionID');
    }
}
