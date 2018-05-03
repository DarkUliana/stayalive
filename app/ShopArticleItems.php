<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopArticleItems extends Model
{
    protected $table = 'shop_article_items';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'articleID', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'inStuck' => 'boolean'
        ];

    public function setInStuckAttribute($value)
    {
        $this->attributes['inStuck'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
