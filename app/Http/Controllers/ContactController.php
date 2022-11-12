<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\VContact;


class ContactController extends Controller
{
    public function index()
    {
        $contact  = Contact::all();
        $response = [ 
            'contact' => $contact , 
        ];
        return  response($response, 200);
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'company_id' =>'required|string|exists:customers,id',
        ]);
        $contact =  Contact::create([
            'company_id' =>$fields['company_id'],
            'title' => $request->title,  
            'full_name' => $request->full_name,  
            'phone' => $request->phone,  
            'email' => $request->email,  
            'description' => $request->description,  
            'is_active' => $request->is_active
       ]);
        $response = [ 
            'contact' => $contact , 
        ];
        return  response($response, 201);
    }
    public function show($id)
    {
        $contact =  Contact::where('id', $id)->first();
        $response = [ 
            'contact' => $contact , 
        ];
        return  response($response, 200);
    }
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'company_id' =>'required|string|unique:customers,id',
        ]);
        $contact =  Contact::where('id', $id)->update([
            'company_id' =>$fields['company_id'],
            'title' => $request->title,  
            'full_name' => $request->full_name,  
            'phone' => $request->phone,  
            'email' => $request->email,  
            'description' => $request->description,  
            'is_active' => $request->is_active
       ]);
        $response = [ 
            'contact' => $contact , 
        ];
        return  response($response, 201);
    }
    public function destroy($id)
    {
        Contact::where('id', $id)->delete();
        $response = [ 
            'message' => 'successfully' , 
        ];
        return  response($response, 200);
    }
    // View
    public function getContact(){
        $contact = VContact::all();
        $response = [
            'contact' =>$contact
        ];
        return response($response , 200);
    }

}