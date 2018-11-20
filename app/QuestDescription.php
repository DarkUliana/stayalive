<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestDescription extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'questID', 'created_at', 'updated_at'];

    public function description()
    {
        return $this->hasOne('App\Description', 'key', 'textKey');
    }
}
