<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    protected $table = 'online';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $appends = ['online'];

    public function getOnlineAttribute()
    {
        $now = new Carbon();
        $player = new Carbon($this->updated_at);
        $diff = $player->diffInSeconds($now, false);

        if ($diff < 30) {
            return 'true';
        }

        return 'false';
    }
}
