<?php

namespace App\Http\Controllers;

use App\City;
use App\Date;
use App\Delivery_time;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('cities.index')->with('cities', City::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$city = new City();
        //return view('cities.create')->with('city', $city);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd("store");
        $this->validate($request, [
            'name' => 'required'
        ]);
        $cities = City::all();
        foreach ($cities as $city) {
            if ($city->name == $request->name) {
                return response()->json([
                    'message' => 'failed : this name of city is exist'
                ]);
            }
        }
        $city = city::create([
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'success : city has been add'
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        City::where('id', $request->city)->update([
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'City has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $city->delete();
        return response()->json([
            'message' => 'city was deleted successfully'
        ]);
    }

    //attaching cities to delivery time
    public function storeDeliveryTimes(Request $request)
    {
        $city = City::find($request->city_id);
        $delivery_time = Delivery_time::find($request->delivery_times);
        $city->delivery_times()->attach($delivery_time);

        return response()->json([
            'message' => 'delivery-time has been stored successfully'
        ]);
    }
    //Store excluded delivery time on a certain date for a given city
    public function excludedDeliveryTimeDate(Request $request)
    {
        $this->validate($request, [
            'delivery_time_id' => 'required',
            'city_id' => 'required',
            'date' => 'required'
        ]);
        Date::create([
            'date' => $request->date,
            'city_id' => $request->city_id,
            'delivery_time_id' => $request->delivery_time_id
        ]);
        return response()->json([
            'message' => 'delivery date excluded stored !'
        ]);
    }
    //return all delivery time excluded excluded delivery time on a certain date for  city
    public function getExcludedDeliveryTimeDate(Request $request)
    {
        //$city = City::findOrFail($request->city_id);
        return response()->json([
            'dates' => Date::where('city_id', $request->city_id)->get()
        ]);
    }
    //get the available delivery times in city
    public function getDeliveryDate(Request $request)
    {
        $city = City::where('id', $request->city_id)->first();
        //get delivery time in $city
        $dt = $city->delivery_times()->get();
        //get all date excluded
        $excluded = Date::all();
        //create today's date
        $now = Carbon::now();
        //create table dates
        $dates = [];
        for ($c = 0; $c < $request->number_of_days; $c++) {
            //add day
            $date = $now->addDays($c);
            //get date exclude in object excluded
            $todays_exclusions = $excluded->where(
                'date',
                $date->format('Y-m-d')
            );
            //affectation delivery time in $todays_dt
            $todays_dt = $dt;
            $part['date'] = $date->format('Y-m-d');
            $part['day_name'] = $date->format('l');
            if (!empty($todays_exclusions)) {
                for ($i = 0; $i < count($todays_dt); $i++) {
                    for ($j = 0; $j < count($todays_exclusions); $j++) {
                        if (
                            $todays_dt[$i]->id ==
                            $todays_exclusions[$j]->delivery_time_id
                        ) {
                            $todays_dt->forget($i);
                        }
                    }
                }
            }
            $part['delivery_times'] = $todays_dt;

            array_push($dates, $part);
        }
        return response()->json(['dates' => $dates]);
    }

    public function excludedDeliveryDate(Request $request)
    {
    }
}