<?php

namespace App\Http\Controllers;

use App\Delivery_time;
use Illuminate\Http\Request;

class DeliveryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Delivery_time::all();
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
            'delivery_at' => 'required'
        ]);
        $deliveries = Delivery_time::all();
        foreach ($deliveries as $delivery) {
            if ($delivery->delivery_at == $request->delivery_at) {
                return 'failed';
                return redirect()
                    ->route('delivery-times.index')
                    ->with('failed', ' delivery time is exist');
            }
        }
        Delivery_time::create([
            'delivery_at' => $request->delivery_at
        ]);
        return response()->json([
            'message' => 'delivery time stored !'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'delivery_at' => 'required'
        ]);

        Delivery_time::where('id', $request->delivery_time)->update([
            'delivery_at' => $request->delivery_at
        ]);
        return response()->json([
            'message' => 'Delivery_time has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Delivery_time::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Delivery_time was deleted successfully'
        ]);
    }
}