<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestorableObjectItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'restorableObjectID', 'isTopList', 'created_at', 'updated_at'
    ];

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'ItemID');
    }
}
