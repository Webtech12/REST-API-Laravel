<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CountryModel;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(CountryModel::get(), 200);
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
        //
        $fill = CountryModel::create($request->all());
        return response()->json($fill, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $country = CountryModel::find($id);
        $retCountry = (is_null($country)) ? 
        'Record not found' : response()->json($country, 200) ;
        return $retCountry;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $val = new CountryModel($id);
        // $fill = CountryModel::update($request->all());
        $val = CountryModel::find($id);
        $retVal = (is_null($val)) ? 
        'Not found' : $val->update($request->all()) ;
        // $val->update($request->all());
        
        return response()->json($retVal, 200);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $val = CountryModel::find($id);
        if (is_null($val)) {
            return response()->json('Not found', 404);
        }
        $val->delete();
        return response()->json(null, 204);
    }
}
