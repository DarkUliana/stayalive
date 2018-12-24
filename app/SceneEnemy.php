<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SceneEnemy extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = [
        'ID', 'created_at', 'updated_at'
    ];

    public function item() {

        return $this->hasMany('App\SceneEnemyItem', 'sceneEnemyID', 'ID');
    }
}
