<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category')->get();
        $response = ['Product' => $product,];
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
            'name' => 'required|string',
            'type' => 'required'
        ]);
        $product =  Product::create([
            'name' => $fields['name'],
            'type' => $fields['type'],
            'price' => $request->price,
            'img' => $request->img,
            'stock' => $request->stock,
            'description' => $request->description,
            'is_active' => $request->is_active
        ]);
        $response = [
            'product' => $product,
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
        $product =  Product::where('id', $id)->first();
        $response = [
            'product' => $product,
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
            'name' => 'required|string',
            'type' => 'required'
        ]);
        $product =  Product::where('id', $id)->update([
            'name' => $fields['name'],
            'type' => $fields['type'],
            'price' => $request->price,
            'stock' => $request->stock,
            'img' => $request->img,
            'description' => $request->description,
            'is_active' => $request->is_active
        ]);
        $response = [
            'product' => $product,
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
        Product::where('id', $id)->delete();
        $response = [
            'message' => 'Successfully',
        ];
        return  response($response, 201);
    }
}
