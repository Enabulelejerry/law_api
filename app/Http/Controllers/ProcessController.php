<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
Use DB;
use Illuminate\Support\Facades\Validator;
use Exception;
class ProcessController extends Controller
{

    public function UploadProcess(Request $request){

        try {
            $rules = array(
                'file_name' => 'required',
                'file_url' => 'required',
                'file_size' => 'required',
                'court_type' => 'required',
            );

            $validator = Validator::make($request->all(),$rules);
                if($validator->fails()){
                    return response()->json(['errors'=>$validator->errors()]);
                }

                $process = new Process();
                $process->lawyer_id = $request->user_id;
                $process->file_name = $request->file_name;
                $process->file_url = $request->file_url;
                $process->court_type = $request->court_type;
                $process->file_size  = $request->file_size;
                $process->status = 0;
                $process->save();
                return response()->json([
                    'message' => 'Process Uploaded Successfully',
                    'status' => 'success',
                    'data' => $process
                  ],200);
        } catch (Exception $ex) {
            return response([
                'message' => $ex->getMessage()
              ],401);
        }
    }

    public function GetProcess(){
        $all_process = Process::get();
        return response()->json([
            'data' => $all_process
          ],200);
    }

    public function PreviewProcess(Request $request){
        $process_id =  $request->process_id;
        $single_process = Process::find($process_id);
         return response()->json([
            'data' => $single_process
          ],200);
    }

    public function LawyerProcess(Request $request){
          $lawyer_id = $request->lawyer_id;
          $assign_lawyer_process = DB::table('processes')
          ->join('headtypes','headtypes.id','=','processes.assign_to_id')->where('processes.lawyer_id',$lawyer_id)
          ->select('processes.file_name', 'processes.file_size', 'processes.court_type', 'processes.created_at', 'processes.status','headtypes.first_name','headtypes.last_name')
          ->get();

          $non_lawyer_process = DB::table('processes')
          ->where('processes.lawyer_id',$lawyer_id)->where('processes.status',0)
          ->select('processes.file_name', 'processes.file_size', 'processes.court_type', 'processes.created_at', 'processes.status')
          ->get();
          $merged = $assign_lawyer_process->merge($non_lawyer_process);
          $result = $merged->all();
        return response()->json([
            'data' => $result
          ],200);
       
    }
}
