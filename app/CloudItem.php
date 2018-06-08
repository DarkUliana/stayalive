<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CloudItem extends Model
{
    protected $primaryKey = 'ID';

    protected  $guarded = [];

    protected $hidden = ['ID', 'googleID', 'created_at', 'updated_at'];

    protected $casts = [
        'inStuck' => 'boolean',
        'isTaken' => 'boolean'
    ];

    public function setInStuckAttribute($value)
    {
        $this->attributes['inStuck'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function setIsTakenAttribute($value)
    {
        $this->attributes['isTaken'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function item()
    {
        return $this->hasOne('App\Item', 'Name', 'imageName');
    }

//    public function currentDurability/
}
