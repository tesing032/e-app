<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */

    public function createUser(Request $request)
    {
        try {
            $validation =Validator::make($request->all(),[
             'name'=>'required',
             'email'=>'required|email|unique:user,email',
             'password'=>'required'
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validation->errors()
                ], 401);
            }
            $user =Users::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);

            return response()->json([
                'status'=>true,
                'message'=> 'User Created successfully',
                'token'=>$user->createToken('API TOKEN')->plainTextToken
              ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
              'status'=>false,
              'message'=> $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $validation =Validator::make($request->all(),[
             'email'=>'required|email',
             'password'=>'required'
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'status'=>false,
                    'message'=>'validation error',
                    'errors'=>$validation->errors()
                ], 401);
            }
            if(!Auth::attempt($request->only(['email','password']))) {
                return response()->json([
                    'status'=>false,
                    'message'=>'Email & Password does not matched',
                ], 401);
            }

            $user=Users::where('email', $request->email)->first();

            return response()->json([
                'status'=>true,
                'message'=> 'User logged in successfully',
                'token'=>$user->createToken('API TOKEN')->plainTextToken
              ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
              'status'=>false,
              'message'=> $th->getMessage()
            ], 500);
        }
    }
}
