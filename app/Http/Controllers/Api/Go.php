<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\CountryModel;

class Go extends Controller
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
        $rules = [
            "iso" => "required|min:2"
        ];
        $validator = Validator::make($request->all(), $rules);
        $retVal = ($validator->fails()) ?
         response()->json($validator->errors(), 400) :
         [$fill = CountryModel::create($request->all()),
         response()->json($fill, 201)];

        // $fill = CountryModel::create($request->all());
        return $retVal;
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
        ["message" => "Record not found", "status" => 404] :
         response()->json($country, 200) ;
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
        $val = CountryModel::find($id);
        $retVal = (is_null($val)) ? 
        ["message" => "Not found", "status" => 404] :
        $val->update($request->all());
        
        return response()->json($retVal, 200);
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
            return response()->json(["message" => "Not found"],404);
        }
        $val->delete();
        return response()->json(null, 204);
    }
}
