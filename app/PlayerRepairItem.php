<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerRepairItem extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['ID', 'playerID', 'created_at', 'updated_at'];

    public function parts()
    {
        return $this->hasMany('App\PlayerRepairItemPart', 'repairItemID', 'ID');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($item) { // before delete() method call this
            $item->parts()->delete();
            // do the rest of the cleanup...
        });
    }
}
