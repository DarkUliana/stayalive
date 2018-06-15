<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerRestorableObject extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = ['ID', 'created_at', 'updated_at'];

    protected $guarded = [];

    public function slots()
    {
        return $this->hasMany('App\PlayerRestorableObjectSlot', 'restorableObjectID', 'ID');
    }
}
