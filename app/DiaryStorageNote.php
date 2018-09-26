<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaryStorageNote extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    public function quests()
    {
        return $this->hasMany('App\DiaryNoteSequence', 'diaryNoteID', 'ID');
    }
}
