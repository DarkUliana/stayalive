<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ID', 'password', 'remember_token', 'email', 'created_at', 'updated_at', 'online'
    ];

    protected $guarded = [];

    protected $casts = [
        'Gender' => 'boolean',
        'isDie' => 'boolean',
        'isSpawnInLocation' => 'boolean',
    ];

    protected $appends = ['online'];
    protected $primaryKey = 'ID';

    public function setGenderAttribute($value)
    {
        $this->attributes['Gender'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function setIsDieAttribute($value)
    {
        $this->attributes['isDie'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function setIsSpawnInLocationAttribute($value)
    {
        $this->attributes['isSpawnInLocation'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public function identificator()
    {
        return $this->hasMany('App\PlayerIdentificator', 'playerID', 'ID');
    }
}
