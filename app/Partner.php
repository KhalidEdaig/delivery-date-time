<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'city_id'];
    //relationship Partner with City
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}