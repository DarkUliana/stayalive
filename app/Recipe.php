<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    public function components()
    {
        return $this->hasMany('App\RecipeComponents', 'recipeID', 'ID');
    }

    public function technologies()
    {
        return $this->hasMany('App\RecipeTechnologies', 'recipeID', 'ID');
    }

    public function type()
    {
        return $this->hasOne('App\RecipeType', 'recipeType', 'index');
    }

    public function classType()
    {
        return $this->hasOne('App\RecipeClassType', 'ID', 'classTypeID');
    }
}
