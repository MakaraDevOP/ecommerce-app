<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activation;

class ActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $activation = Activation::all();
        $response = [ 
            'activation' => $activation , 
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
            'customer_id' =>'required|exists:customers,id',
        ]);
        $activation=  Activation::create([
        'customer_id' =>$fields['customer_id'],
        'details' => $request->details,  
        'is_active' => $request->is_active
       ]);
        $response = [ 
            'activation' => $activation , 
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
        $activation=  Activation::where('id', $id)->first();
        $response = [ 
            'activation' => $activation , 
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
            'customer_id' =>'required|string',
        ]);
        $activation=  Activation::where('id', $id)->update([
        'customer_id' =>$fields['customer_id'],
        'details' => $request->details,  
        'is_active' => $request->is_active
       ]);
        $response = [ 
            'activation' => $activation , 
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
        Activation::where('id', $id)->delete();
        $response = [ 
            'message' => 'successfully' , 
        ];
        return  response($response, 200);
    }
}