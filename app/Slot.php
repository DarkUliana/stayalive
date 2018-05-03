<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at', 'ID', 'googleID'
    ];

    protected $guarded = [];

    protected $casts = [
        'Available' => 'boolean',
        'currentDurability' => 'double'
    ];

    public function setAvailableAttribute($value)
    {
        $this->attributes['Available'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
