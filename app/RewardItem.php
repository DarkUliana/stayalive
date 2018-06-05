<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'rewardID', 'ID'
    ];

    public function item()
    {
        return $this->hasOne('App\Item', 'ID', 'itemID');
    }
}
