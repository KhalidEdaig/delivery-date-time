<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_time extends Model
{
    protected $fillable = ['delivery_at'];
    protected $table = 'delivery_times';
    //relationship City with Delivery
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_delivery_times');
    }

    //inverse relationship date with delivery-time
    public function date()
    {
        return $this->belongsTo(Date::class);
    }
}