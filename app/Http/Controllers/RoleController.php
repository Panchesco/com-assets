<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
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

    public function createRole(Request $request) 
    {
        $input = $request->only('role', 'slug', 'description');

        $validator = Validator::make($input, [
            'role' => 'required:max:16',
            'slug' => 'max:32',
            'description' => 'max:255',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

        $role = Role::updateOrCreate(['role' => $input['role'],'slug' => $input['slug']],$input); // eloquent create or update of data

        $success['role'] = $role;

        return $this->sendResponse($success, 'Role created/updated.', 201);

    }
    
    public function updateRole(Request $request) 
    {
        $input = $request->only('role', 'slug', 'description');

        $validator = Validator::make($input, [
            'role' => 'required|unique:roles',
            'slug' => 'required|unique:roles',
            'description' => 'max:255',
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors(), 'Validation Error', 422);
        }

		$role = Role::updateOrCreate(
			['role' => $input['role'], 'slug' => $input['slug']],
			['description' => $input['description']]
		);
		

        return $this->sendResponse($success, 'Role updated.', 201);

    }
}
