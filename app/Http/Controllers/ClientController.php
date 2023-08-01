<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Type;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category')->get();
        $category = Type::all();
        $response = [
            'Product' => $product,
            'category' => $category
        ];
        return  response($response, 200);
    }
    public function show($id)
    {
        $activation =  Product::where('id', $id)->first();
        // $data = array([
        //     "id" => $activation->id,
        //     "customer_id" => $activation->customer_id,
        //     "details"  => $activation->details,
        //     "is_active" => $activation->is_active,
        // ]);
        $response = [
            'data' => $activation,
        ];
        return  response($response, 200);
    }
}
