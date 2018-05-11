<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'ID'
    ];

    protected $appends = ['id'];

    public static $snakeAttributes = false;

    public function rewardList()
    {
        return $this->hasMany('App\RewardItem', 'rewardID', 'ID');
    }

    public function getIdAttribute()
    {
        return $this->attributes['ID'];
    }
}
