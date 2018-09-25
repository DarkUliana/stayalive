<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaryNoteSequence extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'questSequenceID', 'created_at', 'updated_at'
    ];
}
