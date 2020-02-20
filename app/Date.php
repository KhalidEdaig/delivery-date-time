<?php

namespace App;

use App\Delivery_time;
use App\City;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = ['date', 'city_id', 'delivery_time_id'];
    protected $table = 'dates';
    //relationship date with delivery-time
    public function deliveries()
    {
        return $this->hasMany(Delivery_time::class);
    }

    //relationship date with delivery-time
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}