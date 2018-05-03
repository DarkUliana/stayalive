<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnologyItems extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
      'ID', 'technologyID'
    ];

    public $timestamps = false;

    protected $table = 'technology_oppened_items';

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'itemID');
    }

}
