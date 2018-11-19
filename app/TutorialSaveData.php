<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorialSaveData extends Model
{
    protected $table = 'tutorial_save_data';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'isComplete' => 'boolean'
    ];

    public function setIsComplete($value)
    {
        $this->attributes['isComplete'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
