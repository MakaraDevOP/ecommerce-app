<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;

class TermContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term =  Term::all();
        $response = [ 
            'term' => $term , 
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
            'name' =>'required|string',
            'term' =>'required|string',
        ]);
        $term =  Term::create([
        'name' =>$fields['name'],
        'term' =>$fields['term'],
        'description' => $request->description
       ]);
        $response = [ 
            'term' => $term , 
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
        $term =  Term::where('id',$id)->first();
        $response = [ 
            'term' => $term , 
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
            'name' =>'required|string',
            'term' =>'required|string',
        ]);
        $term =  Term::where('id',$id)->update([
        'name' =>$fields['name'],
        'term' =>$fields['term'],
        'description' => $request->description
       ]);
        $response = [ 
            'term' => $term , 
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
        $term =  Term::where('id',$id)->delete();
        $response = [ 
            'term' => $term , 
        ];
        return  response($response, 201);
    }
}