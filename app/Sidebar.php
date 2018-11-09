<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $table = 'sidebar';

    protected $primaryKey = 'ID';

    protected $guarded = [];
}
