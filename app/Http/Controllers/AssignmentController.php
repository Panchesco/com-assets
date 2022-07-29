<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Http\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Http\Helpers\sendResponse(Assignment::get(),'All Assignments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \App\Http\Helpers\sendResponse([],'Assigment form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = $request->only('user_id','asset_id','notes','checked_out','turned_in');
           
           $validator = Validator::make($input, [
            'user_id' => 'required:numeric',
            'asset_id' => 'required|numeric'
            ]);
            
            if($validator->fails()){
            return \App\Http\Helpers\sendError($validator->errors(), 'Validation Error', 422);
        }
        
        $assignment = Assignment::updateOrCreate([	'user_id' => $input['user_id'],
      									'asset_id' => $input['asset_id']],$input); 

        $success['assignment'] = $assignment;

        return \App\Http\Helpers\sendResponse($success, 'Assigment saved', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
