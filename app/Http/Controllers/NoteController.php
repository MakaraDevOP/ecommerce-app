<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Vnote;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note =  Note::all();
        $response = [ 
            'note' => $note , 
        ];
        return  response($response, 201);
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
            'activation_id' =>'required|string',
            'activation_line_id' =>'required|string',
            'user_id' =>'required|string'
        ]);
        $note =  Note::create([
        'activation_id' =>$fields['activation_id'],
        'activation_line_id' =>$fields['activation_line_id'],
        'user_id' =>$fields['user_id'],
        'body' => $request->body,  
        'title' => $request->title
       ]);
        $response = [ 
            'note' => $note , 
        ];
        return  response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note =  Note::where('id', $id)->first();
        $response = [ 
            'note' => $note , 
        ];
        return  response($response, 201);
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
        $fields = $request->validate([
            'activation_id' =>'required|string',
            'activation_line_id' =>'required|string',
            'user_id' =>'required|string'
        ]);
        $note =  Note::where('id', $id)->update([
        'activation_id' =>$fields['activation_id'],
        'activation_line_id' =>$fields['activation_line_id'],
        'user_id' =>$fields['user_id'],
        'body' => $request->body,  
        'title' => $request->title
       ]);
        $response = [ 
            'note' => $note , 
        ];
        return  response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::where('id', $id)->delete();
        $response = [ 
            'message' => 'successfully' , 
        ];
        return  response($response, 200);
    }
    // Get note by activate line
     public function getNotebyActivationLine(Request $request , $activation, $activationLineID)
    {
       $note =  Vnote::where('activation_id', $activation)->where('activation_line_id', $activationLineID)->get();
        $response = [ 
            'note' => $note , 
        ];
        return  response($response, 200);
    }
    public function getVNote(){
       $note  = Vnote::all();
       $response = [
        'note' => $note,
       ];
       return response($response, 200);
    }
    public function getVNoteByActivation($id){
        $note = Vnote::where('activation_id',$id)->get();
        $response = [
        'note' => $note,
       ];
       return response($response, 200);
    }
}