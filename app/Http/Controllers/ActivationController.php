<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activation;
use App\Models\VActivation;

class ActivationController extends Controller
{

    public function index()
    {
         $activation = Activation::all();
        $response = [ 
            'activation' => $activation , 
        ];
        return  response($response, 200);
    }
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

    public function show($id)
    {
        $activation=  Activation::where('id', $id)->first();
        $response = [ 
            'activation' => $activation , 
        ];
        return  response($response, 200);
    }

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

    public function destroy($id)
    {
        Activation::where('id', $id)->delete();
        $response = [ 
            'message' => 'successfully' , 
        ];
        return  response($response, 200);
    }
    public function getActivationLine(){
        $activation = VActivation::all();
        $response = [
            'activation' =>$activation
        ];
        return response($response , 200);
    }
}