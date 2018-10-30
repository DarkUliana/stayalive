<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerBuildingTechnology extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'ID', 'playerID'
    ];

    protected $casts = [
        'inBuilding' => 'boolean',
    ];

    public function states()
    {
        return $this->hasMany('App\PlayerTechnologiesStates', 'playerID', 'playerID');
    }

    public function setInBuildingAttribute($value)
    {
        $this->attributes['inBuilding'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
