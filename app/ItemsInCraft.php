<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ItemsInCraft extends Model
{
    protected $table = 'items_in_craft';

    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'updated_at', 'ID', 'googleID'
    ];

    protected $guarded = [];

    public function getTimeToCraftAttribute($value)
    {
        return  $value - Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->diffInSeconds(Carbon::now());
    }
}
