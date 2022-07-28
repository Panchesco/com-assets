<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
	
    public function sendResponse($data, $message, $status = 200) 
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }

    public function sendError($errorData, $message, $status = 500)
    {
        $response = [];
        $response['message'] = $message;
        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sendResponse(Asset::get(),'All Assets');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		return $this->sendResponse([],'Form for creating an asset goes here.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only('title', 'description', 'serial');
           
           $validator = Validator::make($input, [
            'title' => 'required:max:42',
            'serial' => 'required',
            ]);
            
            if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }
        
        $msg = (Asset::where('serial',$input['serial']))->first() ? "Asset updated." : "Asset created.";

        $asset = Asset::updateOrCreate(['serial' => $input['serial']],$input); 

        $success['asset'] = $asset;

        return $this->sendResponse($success, $msg, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $id)
    {
        $asset = Asset::find($id);
                
        return $this->sendResponse($asset, "", 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $id)
    {
	    
	    die('bongo');
        return $this->sendResponse([],'Form for editing an asset goes here.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        $this->store();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $input = $request->only('id');
       
        $validator = Validator::make($input, [
            'id' => 'required|numeric|min:0|not_in:0',
            ]);
            
            if($validator->fails()){
            return $this->sendError($validator->errors(), 'Asset id is missing', 422);
        }
       
       
       $asset = Asset::find($input['id']);
       
       $destroy = Asset::destroy($input['id']);
       return $this->sendResponse($asset, "This asset has been removed.", 201);
       
    }
}
