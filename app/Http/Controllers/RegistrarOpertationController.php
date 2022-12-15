<?php

namespace App\Http\Controllers;

use App\Models\AssignCase;
use App\Models\CaseModel;
use App\Models\Process;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class RegistrarOpertationController extends Controller
{
    
    public function CreateCase(Request $request){
         try {
            $rules = array(
                'title' => 'required|unique:case_models,title',
                'assign_to_id' => 'required',
            );

            $validator = Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return response()->json(['errors'=>$validator->errors()]);
                }
            
                $case = new CaseModel();
                $case->title = $request->title;
                $case->assign_to_id = $request->assign_to_id;
                $case->save();
                return response()->json([
                    'message' => "case created Successfully",
                    'data' => $case
                 ],200);

         } catch (Exception $ex) {
            return response([
              'messsage' => $ex->getMessage()
            ],401);
        }
    }

    public function GetCase(){
        $allcases = CaseModel::get();
        return response()->json([
            'data' => $allcases
         ],200);
    }

    public function AssignCase(Request $request){

        try {
            $rules = array(
                'document_url' => 'required',
            );

            $validator = Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return response()->json(['errors'=>$validator->errors()]);
                }

                $assignCase =  new AssignCase();
                $assignCase->case_id  = $request->case_id;
                $assignCase->assign_to_id  = $request->assign_to_id;
                $assignCase->document_url  = $request->document_url;
                $assignCase->lawyer_id  = $request->lawyer_id;
                $assignCase->save();
                 $process = Process::find($request->case_id);
                 $process->assign_to_id  = $request->assign_to_id;
                 $process->status  = 1;
                 $process->update();
                return response()->json([
                    'message' => "case Assigned Successfully",
                    'data' => $assignCase
                 ],200);
        } catch (Exception $ex) {
            return response([
              'messsage' => $ex->getMessage()
            ],401);
        }
    }
}
