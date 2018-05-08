<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function fields()
    {
        return $this->hasMany('App\QuestField', 'questID', 'ID');
    }

    public function type()
    {
        return $this->hasOne('App\QuestType', 'ID', 'typeID');
    }
}
