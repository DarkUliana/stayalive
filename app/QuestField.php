<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestField extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function fieldName()
    {
        return $this->hasOne('App\AdditionalQuestsField', 'ID', 'fieldID');
    }
}
