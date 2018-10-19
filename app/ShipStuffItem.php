<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipStuffItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'stuffID', 'created_at', 'updated_at'
    ];

    public function cell()
    {
        return $this->hasOne('App\ShipCellType', 'index', 'cellType');
    }

    public function technology()
    {
        return $this->hasOne('App\TechnologyType', 'index', 'technologyType');
    }

    public function direction()
    {
        return $this->hasOne('App\Direction', 'index', 'dir');
    }
}
