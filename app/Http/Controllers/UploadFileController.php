<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadFile;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'activation_id' =>'required',
        ]);
        if ($request->hasFile('files')) {
            $name = $request->file('files')->getClientOriginalName();
            $size = $request->file('files')->getSize();
            $type = $request->file('files')->getClientOriginalExtension();
            $path =  $request->file('files')->storeAs('public/images' , date('mdYHis') ."_". $name);
            $files =  UploadFile::create([
               'activation_id' =>$fields['activation_id'],
               'file_path' =>  date('mdYHis') ."_". $name,  
               'name' => $name,
               'size' =>  $size ,
               'type' => $type
              ]);
              $response = [ 
                  'file' => $files , 
              ];
              return  response($response, 201);
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
    public function getUploadFileByActivation(Request $request, $id){

        $files = UploadFile::where('activation_id', $id)->get();
        $response = [ 
            'file' => $files , 
        ];
        return  response($response, 200);

    }
}