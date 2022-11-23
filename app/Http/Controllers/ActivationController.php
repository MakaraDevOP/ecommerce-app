<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activation;
use App\Models\VActivation;
use App\Models\ActivationLine;
use Illuminate\Support\Facades\DB;
use App\Models\Note;

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
        //TRANSACTION 
        DB::transaction(function () use ($request , $fields) {
            //ACTIVATION
            $activation=Activation::create([
                'customer_id' =>$fields['customer_id'],
                'details' => $request->details,  
                'is_active' => $request->is_active
            ]);
            //ACTIVATION LINE
            if($request->activation_line){
                if(count($request->activation_line)>0){
                    collect($request->activation_line)->each(function (array $items) use ($request,$activation) {
                        $activationLine = ActivationLine::create(
                            [ 
                                'activation_id' =>$activation->id,
                                'product_id' =>$items['product_id'],
                                'term_id' =>$items['term_id'],
                                'user_no' =>$items['user_no'],
                                'period' =>$items['period'],
                                'note' => $items["note"], 
                                'activated_date' =>$items["activated_date"],  
                                'expired_date' => $items["expired_date"],  
                                'status' =>$items["status"], 
                                'is_free' =>$items["is_free"], 
                                'is_notify_email' =>$items["is_notify_email"],  
                                'order_by' =>$items["order_by"], 
                                'is_active' => $items["is_active"]
                            ]
                        );
                    });
                }
            }
            return $activation;
        });
        $response = [ 
             'message' => 'successfully' , 
        ];
        return  response($response, 201);
    }
    
    public function show($id)
    {
        $activation=  Activation::where('id', $id)->first();
        $activationLine = ActivationLine::where('activation_id' ,$id)->get();
        $data = array([
           "id" =>$activation->id,
           "customer_id" =>$activation->customer_id,
           "details"  =>$activation->details,
           "is_active" =>$activation->is_active,
           "activation_line" =>$activationLine
        ]);
        $response = [ 
            'activation' => $data , 
        ];
        return  response($response, 200);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'customer_id' =>'required',
        ]);
        $activation=  Activation::where('id', $id)->update([
            "customer_id" =>$request->customer_id,
           "details"  =>$request->details,
           "is_active" =>$request->is_active,
        ]);
        if(count($request->activation_line)>0){
            collect($request->activation_line)->each(function (array $items) use ($request , $id) {
                //Update 
                if( isset($items['id']) ){
                    ActivationLine::where('id', $items['id'])->update(
                            [ 
                                'activation_id' =>$id,
                                'product_id' =>$items['product_id'],
                                'term_id' =>$items['term_id'],
                                'user_no' =>$items['user_no'],
                                'period' =>$items['period'],
                                'note' => $items["note"], 
                                'activated_date' =>$items["activated_date"],  
                                'expired_date' => $items["expired_date"],  
                                'status' =>$items["status"], 
                                'is_free' =>$items["is_free"], 
                                'is_notify_email' =>$items["is_notify_email"],  
                                'order_by' =>$items["order_by"], 
                                'is_active' => $items["is_active"]
                            ]
                        );
                }else{
                         ActivationLine::create(
                            [ 
                                'activation_id' => $id,
                                'product_id' =>$items['product_id'],
                                'term_id' =>$items['term_id'],
                                'user_no' =>$items['user_no'],
                                'period' =>$items['period'],
                                'note' => $items["note"], 
                                'activated_date' =>$items["activated_date"],  
                                'expired_date' => $items["expired_date"],  
                                'status' =>$items["status"], 
                                'is_free' =>$items["is_free"], 
                                'is_notify_email' =>$items["is_notify_email"],  
                                'order_by' =>$items["order_by"], 
                                'is_active' => $items["is_active"]
                            ]
                        );

                }
             });
         }
        $response = [ 
            'message' => 'successfully' , 
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