<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestFieldType extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    public function fieldName()
    {
        return $this->hasOne('App\Property', 'ID', 'fieldID');
    }
}
