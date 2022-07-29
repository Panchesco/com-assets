<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Helpers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function register(Request $request) 
    {
        $input = $request->only('name', 'email', 'password', 'role_id', 'c_password');

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|numeric|min:0|not_in:0',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return \App\Http\Helpers\sendError($validator->errors(), 'Validation Error', 422);
        }

        $input['password'] = bcrypt($input['password']); // use bcrypt to hash the passwords
        $user = User::create($input); // eloquent creation of data

        $success['user'] = $user;

        return \App\Http\Helpers\sendResponse($success, 'user registered successfully', 201);

    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return \App\Http\Helpers\sendError($validator->errors(), 'Validation Error', 422);
        }

        try {
            // this authenticates the user details with the database and generates a token
            if (! $token = JWTAuth::attempt($input)) {
                return $this->sendError([], "invalid login credentials", 400);
            }
        } catch (JWTException $e) {
            return \App\Http\Helpers\sendError([], $e->getMessage(), 500);
        }

        $success = [
            'token' => $token,
        ];
        return \App\Http\Helpers\sendResponse($success, 'successful login', 200);
    }

    public function getUser() 
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return \App\Http\Helpers\sendError([], "user not found", 403);
            } 
        } catch (JWTException $e) {
            return \App\Http\Helpers\sendError([], $e->getMessage(), 500);
        }

        return \App\Http\Helpers\sendResponse($user, "user data retrieved", 200);
    }
}