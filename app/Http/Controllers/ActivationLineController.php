<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivationLine;
class ActivationLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activationLine =  ActivationLine::all();
         $response = [ 
            'activation_line' => $activationLine, 
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
            'activation_id' =>'required|string',
            'product_id' =>'required|string',
            'term_id' =>'required|string',
            'user_no' =>'required|string',
            'period' =>'required|string',

        ]);
        $activationLine =  ActivationLine::create([
        'activation_id' =>$fields['activation_id'],
        'product_id' =>$fields['product_id'],
        'term_id' =>$fields['term_id'],
        'user_no' =>$fields['user_no'],
        'period' => $fields['period'],
        'note' => $request->note,  
        'activated_date' => $request->activated_date,  
        'expired_date' => $request->expired_date,  
        'status' => $request->status,  
        'is_free' => $request->is_free,  
        'is_notify_email' => $request->is_notify_email,  
        'order_by' => $request->order_by,  
        'is_active' => $request->is_active
       ]);
        $response = [ 
            'activation_line' => $activationLine , 
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
        $activationLine =  ActivationLine::where('id', $id)->first();
         $response = [ 
            'activation_line' => $activationLine, 
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
            'activation_id' =>'required|string',
            'product_id' =>'required|string',
            'term_id' =>'required|string',
            'user_no' =>'required|string',
            'period' =>'required|string',

        ]);
        $activationLine =  ActivationLine::where('id', $id)->update([
        'activation_id' =>$fields['activation_id'],
        'product_id' =>$fields['product_id'],
        'term_id' =>$fields['term_id'],
        'user_no' =>$fields['user_no'],
        'period' => $fields['period'],
        'note' => $request->note,  
        'activated_date' => $request->activated_date,  
        'expired_date' => $request->expired_date,  
        'status' => $request->status,  
        'is_free' => $request->is_free,  
        'is_notify_email' => $request->is_notify_email,  
        'order_by' => $request->order_by,  
        'is_active' => $request->is_active
       ]);
        $response = [ 
            'activation_line' => $activationLine , 
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
        $activationLine =  ActivationLine::where('id', $id)->delete();
         $response = [ 
            'message' => 'successfully' , 
        ];
        return  response($response, 200);
        
    }
}