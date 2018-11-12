<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestorableObject extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
       'ID', 'created_at', 'updated_at'
    ];

    public function items()
    {
        return $this->hasMany('App\RestorableObjectItem', 'restorableObjectID', 'ID');
    }

    public function cells()
    {
        return $this->hasMany('App\RestorableObjectCell', 'restorableObjectID', 'ID');
    }
}
