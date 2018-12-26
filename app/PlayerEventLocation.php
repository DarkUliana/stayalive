<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerEventLocation extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'playerID', 'created_at', 'updated_at',
    ];

    protected $casts = [
        'needToRaise' => 'boolean',
        'isRaised' => 'boolean'
    ];

    public function setIsRaisedAttribute($value)
    {
        $this->attributes['isRaised'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function setNeedToRaiseAttribute($value)
    {
        $this->attributes['needToRaise'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
