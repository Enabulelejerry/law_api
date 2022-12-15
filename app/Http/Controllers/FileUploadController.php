<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try {
             
            $all_file  = FileUpload::get();
            return response()->json([
                'data' =>$all_file,
            ]);

        } catch (Exception $ex) {
            return response([
                'messsage' => $ex->getMessage()
            ],401);
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {
            
            $rules = array(
               'title' => 'required',
               'image_url' => 'required',
               'file_type' => 'required',
            );
            
            $validator = Validator::make($request->all(),$rules);
             
            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }

            $filemodel = new FileUpload();
            $filemodel->title = $request->title;
            $filemodel->image_url = $request->image_url;
            $filemodel->file_type = $request->file_type;
            $filemodel->save();
            return response()->json([
              'message' => 'Document Uploaded Successfully',
              'status' => 'success'
            ],200);

         } catch (Exception $ex) {
            return response([
                'messsage' => $ex->getMessage()
            ],401);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
