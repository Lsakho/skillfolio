<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
  
        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
  
        $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;
  
        return response()->json([
            // 'token' => $token,
            'headers' => [

                'Accept' => 'application/json',
            
                'Authorization' => 'Bearer '.$token,
                'message' => 'registration successful',
            
            ]
        ], 200);    }
  
    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel-9-Passport-Auth')->accessToken;
            return response()->json([
                // 'token' => $token,
                'headers' => [

                    'Accept' => 'application/json',
                
                    'Authorization' => 'Bearer '.$token,
                    'message' => 'Login successful.',
                
                ]
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
 
    public function userInfo() 
    {
 
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
    }
};