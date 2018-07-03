<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'ID';

    protected $guarded = [];

    protected $hidden = ['isSimple', 'expiration_date', 'created_at', 'updated_at'];

    public function description()
    {
        return $this->hasOne('App\Description', 'ID', 'descriptionID');
    }
}
