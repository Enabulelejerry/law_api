<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class LoginController extends Controller
{
    public function LoginUser(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                ['errors' => $validator->errors()]
            );
        };

        if(Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
            $token = $user->createToken('app')->accessToken;

            return response([
              'message' => 'Successfully Login',
              'token' => $token,
              'user' => $user
            ],200);
        }else{
            return response([
                'error' => 'invalid email or Password'
            ],401);
        }
    }
}
