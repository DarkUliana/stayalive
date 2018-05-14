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

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'value');
    }

    public function technology()
    {
        return $this->hasOne('App\Technology', 'ID', 'value');
    }

    public function enemy()
    {
        return $this->hasOne('App\Enemy', 'ID', 'value');
    }

}
