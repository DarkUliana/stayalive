<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = ['allLanguages'];

    protected $guarded = [];

    public function localizations()
    {
        return $this->hasMany('App\DescriptionLocalization', 'descriptionID', 'ID');
    }

    public function getAllLanguagesAttribute()
    {
        return $this->localizations()->count();
    }
}
