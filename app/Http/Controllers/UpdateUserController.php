<?php

namespace App\Http\Controllers;

use App\Models\Stamp;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;

class UpdateUserController extends Controller
{
    public function UpdateUser(Request $request){
        try {
            $rules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_no' => 'required',
                'password' => 'confirmed|min:6',
            );

            $validator = Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return response()->json(['errors'=>$validator->errors()]);
                }

                $user = User::find($request->user_id);
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->phone_no = $request->phone_no;
                $user->passport_url = $request->passport_url;
                if($request->password){
                $user->password = Hash::make($request->password);
                }
                $user->update();
                if($user){
                    return response()->json([
                        'message' => "Successfully updated",
                        'user' => $user
                     ],200);
                }

        } catch (Exception $ex) {
            
            return response([
              'messsage' => $ex->getMessage()
            ],401);
        }
    }

    public function  UploadStamp (Request $request){

        try {
            $rules = array(
                'stamp_url' => 'required',
            );

            $validator = Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return response()->json(['errors'=>$validator->errors()]);
                }
                $stamp = Stamp::updateOrCreate(['lawyer_id' =>$request->lawyer_id],[
                    'lawyer_id' => $request->lawyer_id,
                    'stamp_url' => $request->stamp_url,
                
                ]);

                return response()->json([
                    'message' => "Stamp Updated Successfully",
                    'data' => $stamp,
                 ],200);

        } catch (Exception $ex) {
            return response()->json([
              'messsage' => $ex->getMessage()
            ],401);
        }
    }

    public function GetStamp(Request $request){
        $get_stamp = Stamp::find($request->lawyer_id);
        return response()->json([
            'data' => $get_stamp,
         ],200);

    }
}
