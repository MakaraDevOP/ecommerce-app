<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\VContact;
use App\Models\Type;


class ContactController extends Controller
{
    public function index()
    {
        $contact  = Type::all();
        $response = [
            'contact' => $contact,
        ];
        return  response($response, 200);
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
        ]);
        $contact =  Type::create([
            'name' => $request->name,
            'img' => $request->img,
            'description' => $request->description,
        ]);
        $response = [
            'contact' => $contact,
        ];
        return  response($response, 201);
    }
    public function show($id)
    {
        $contact =  Type::where('id', $id)->first();
        $response = [
            'contact' => $contact,
        ];
        return  response($response, 200);
    }
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required',
        ]);
        $contact =  Type::where('id', $id)->update([
            'name' => $request->name,
            'img' => $request->img,
            'description' => $request->description,
        ]);
        $response = [
            'contact' => $contact,
        ];
        return  response($response, 201);
    }
    public function destroy($id)
    {
        Type::where('id', $id)->delete();
        $response = [
            'message' => 'successfully',
        ];
        return  response($response, 200);
    }
    // View
    public function getContact()
    {
        $contact = Type::all();
        $response = [
            'contact' => $contact
        ];
        return response($response, 200);
    }
}
