<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $guarded = [];

    protected $casts = [
        'isBuilding' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany('App\TechnologyItems', 'technologyID', 'ID');
    }

    public function setIsBuildingAttribute($value)
    {
        $this->attributes['isBuilding'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
