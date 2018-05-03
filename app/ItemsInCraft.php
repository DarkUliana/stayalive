<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ItemsInCraft extends Model
{
    protected $table = 'items_in_craft';

    protected $primaryKey = 'ID';

    protected $hidden = [
        'created_at', 'ID', 'googleID'
    ];

    protected $guarded = [];


    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s A');
    }
}
