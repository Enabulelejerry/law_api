<?php

namespace App\Http\Controllers;

use App\Models\Lawer;
use App\Models\Nonlawer;
use App\Models\Registrar;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function RegisterUser(Request $request)
    {
        try {
            
          
            $user_type = $request->user_type;
              
            // register lawyer
            if($user_type === 'lawyer'){
                $rules = array(
                    'user_type' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone_no' => 'required|unique:users,phone_no',
                    'password' => 'required|min:5',
                    'email' => 'required|email|unique:users,email',
                );
    
                $validator = Validator::make($request->all(),$rules);
                    if($validator->fails()){
                        return response()->json(['errors'=>$validator->errors()]);
                    }
              $user = User::create([
                 'user_type' => $user_type,
                 'first_name' => $request->first_name,
                 'last_name' => $request->last_name,
                 'phone_no' => $request->phone_no,
                 'email' => $request->email,
                 'password'=>Hash::make($request->password)
              ]);
              $token = $user->createToken('app')->accessToken;
            };


             // register non_lawyer
             if($user_type === 'nonlawyer'){
                $rules = array(
                    'user_type' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone_no' => 'required|unique:users,phone_no',
                    'password' => 'required|min:5',
                    'email' => 'required|email|unique:users,email',
                );
    
                $validator = Validator::make($request->all(),$rules);
                    if($validator->fails()){
                        return response()->json(['errors'=>$validator->errors()]);
                    }

                $user = User::create([
                    'user_type' => $user_type,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_no' => $request->phone_no,
                    'email' => $request->email,
                    'password'=>Hash::make($request->password)
                ]);
                $token = $user->createToken('app')->accessToken;
              };

                // register registrar
             if($user_type === 'registrar'){
                $rules = array(
                    'user_type' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'phone_no' => 'required|unique:users,phone_no',
                    'password' => 'required|min:5',
                    'email' => 'required|email|unique:users,email',
                );
    
                $validator = Validator::make($request->all(),$rules);
                    if($validator->fails()){
                        return response()->json(['errors'=>$validator->errors()]);
                    }
                $user = User::create([
                   'user_type' => $user_type,
                   'first_name' => $request->first_name,
                   'last_name' => $request->last_name,
                   'phone_no' => $request->phone_no,
                   'email' => $request->email,
                   'password'=>Hash::make($request->password)
                ]);
                $token = $user->createToken('app')->accessToken;
              }

              return response()->json([
                'message' => "Successfully Registered",
                'token' => $token,
                'user' => $user
             ],200);



        } catch (Exception $ex) {
            
            return response([
              'messsage' => $ex->getMessage()
            ],401);
        }
    }
}