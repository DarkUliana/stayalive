<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestSequence extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function quests()
    {
        return $this->hasMany('App\QuestSequenceQuest', 'questSequenceID', 'ID');
    }
}
