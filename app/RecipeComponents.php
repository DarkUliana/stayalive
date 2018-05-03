<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeComponents extends Model
{
    protected $primaryKey = 'ID';

    protected $table = 'recipe_components';

    public $timestamps = false;

    protected $guarded = [];

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'itemID');
    }
}
