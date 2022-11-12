<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preference;
class PreferanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preference =  Preference::all();
        $response = [ 
            'preference' => $preference , 
        ];
        return  response($response, 200);
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
            'updated_by' =>'required|string',
        ]);
        $preference =  Preference::create([
        'updated_by' =>$fields['updated_by'],
        'mail_to' => $request->mail_to,
        'mail_cc' => $request->mail_cc,
        'is_send_mail' => $request->is_send_mail,

       ]);
        $response = [ 
            'preference' => $preference , 
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
        $preference =  Preference::where('id', $id)->first();
        $response = [ 
            'preference' => $preference , 
        ];
        return  response($response, 200);
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
            'updated_by' =>'required|string',
        ]);
        $preference =  Preference::where('id', $id)->update([
        'updated_by' =>$fields['updated_by'],
        'mail_to' => $request->mail_to,
        'mail_cc' => $request->mail_cc,
        'is_send_mail' => $request->is_send_mail,

       ]);
        $response = [ 
            'preference' => $preference , 
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
        $preference =  Preference::where('id', $id)->delete();
        $response = [ 
            'preference' => $preference , 
        ];
        return  response($response, 201);
    }
}