<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestType extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function field()
    {
        return $this->hasOne('App\QuestFieldType', 'typeID', 'ID');
    }
}
