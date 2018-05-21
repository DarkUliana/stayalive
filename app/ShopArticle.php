<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ShopArticle extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'onSale', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'inGold' => 'boolean',
        'hot' => 'boolean',
        'onSale' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany('App\ShopArticleItems', 'articleID', 'ID');
    }

    public function setInGoldAttribute($value)
    {
        $this->attributes['inGold'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function setHotAttribute($value)
    {
        $this->attributes['hot'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function setOnSaleAttribute($value)
    {
        $this->attributes['hot'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
