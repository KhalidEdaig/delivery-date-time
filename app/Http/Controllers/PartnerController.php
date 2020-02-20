<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner = Partner::find(1);
        return $partner->city;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $city = Partner::create([
            'name' => $request->name,
            'city_id' => $request->city_id
        ]);
        return 'Success name has been created';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $this->validate($request, [
            'name' => 'required',
            'city_id' => 'required'
        ]);

        if (
            Partner::where('id', $partner)->update([
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
        if (Partner::findOrFail($id)->delete()) {
            return response()->json([
                'message' => 'Partner was deleted successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'delete failed of Partners'
            ]);
        }
    }
}