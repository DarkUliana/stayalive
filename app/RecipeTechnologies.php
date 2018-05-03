<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeTechnologies extends Model
{
    protected $primaryKey = 'ID';

    protected $table = 'recipe_technologies';

    public $timestamps = false;

    protected $guarded = [];

    public function technology()
    {
        return $this->hasOne('App\Technology', 'ID', 'technologyID');
    }
}
