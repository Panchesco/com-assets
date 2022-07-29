<?php

namespace App\Http\Controllers;
use App\Http\Helpers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{

    public function create(Request $request) 
    {
        return \App\Http\Helpers\sendResponse([],'Create role form here',200);

    }
    
    public function update(Request $request) 
    {
        $input = $request->only('role', 'slug', 'description');

        $validator = Validator::make($input, [
            'role' => 'required',
            'slug' => 'required',
            'description' => 'max:255',
        ]);
        
        if($validator->fails()){
            return \App\Http\Helpers\sendError($validator->errors(), 'Validation Error', 422);
        }

		$role = Role::updateOrCreate(
			['role' => $input['role'], 'slug' => $input['slug']],
			['description' => $input['description']]
		);
		

        return \App\Http\Helpers\sendResponse($role, 'Role updated.', 201);

    }
}
