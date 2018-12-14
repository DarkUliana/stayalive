<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'created_at', 'updated_at'];

    protected $casts = [
        'serverAvailable' => 'boolean',
    ];

    public function setServerAvailableAttribute($value)
    {
        $this->attributes['serverAvailable'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
