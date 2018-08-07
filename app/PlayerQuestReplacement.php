<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerQuestReplacement extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $casts = [
        'replaced' => 'boolean'
    ];

    public function setReplacementAttribute($value)
    {
        $this->attributes['replaced'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
