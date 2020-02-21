<?php

namespace App;

use App\Delivery_time;
use App\Partner;
use App\Date;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];
    protected $table = 'cities';
    //inverse relationship City with Delivery
    public function delivery_times()
    {
        return $this->belongsToMany(
            Delivery_time::class,
            'city_delivery_times'
        );
    }
    //inverse relationship City with Partner
    public function partner()
    {
        return $this->hasOne(Partner::class);
    }
    //inverse relationship City with Date
    public function dates()
    {
        return $this->hasMany(Date::class);
    }
}