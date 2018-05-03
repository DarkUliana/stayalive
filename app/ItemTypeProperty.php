<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTypeProperty extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function propertyName()
    {
        return $this->hasOne('App\Property', 'ID', 'propertyID');
    }
}
