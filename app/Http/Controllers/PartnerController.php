<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
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
        $city = Partner::create([
            'name' => $request->name,
            'city_id' => $request->city_id
        ]);
        return 'Success name has been created';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'city_id' => 'required'
        ]);

        if (
            Partner::where('id', $request->partner)->update([
                'name' => $request->name,
                'city_id' => $request->city_id
            ])
        ) {
            return response()->json([
                'message' => 'Partner was updated successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Partner was deleted successfully'
        ]);
    }
}