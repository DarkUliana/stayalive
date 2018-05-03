<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptionLocalization extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $guarded = [];

    public function properties()
    {
        return $this->belongsTo('App\Description', 'descriptionID', 'ID');
    }

    public function language()
    {
        return $this->hasOne('App\Language', 'ID', 'languageID');
    }
}
