<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function items()
    {
        return $this->hasMany('App\RewardItem', 'rewardID', 'ID');
    }
}
