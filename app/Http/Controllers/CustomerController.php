<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        $response = [
            'customer' => $customer,
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
            'company_name' => 'required|string'
        ]);
        $customer =  Customer::create([
            'company_name' => $fields['company_name'],
            'province_city' => $request->province_city,
            'detail_address' => $request->detail_address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'parent_company_id' => $request->parent_company_id,
            'is_active' => $request->is_active
        ]);
        $response = [
            'customer' => $customer,
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
        $customer = Customer::where('id', $id)->first();
        $response = [
            'customer' => $customer,
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
            'company_name' => 'required|string'
        ]);
        $customer =  Customer::where('id', $id)->update([
            'company_name' => $fields['company_name'],
            'province_city' => $request->province_city,
            'detail_address' => $request->detail_address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'parent_company_id' => $request->parent_company_id,
            'is_active' => $request->is_active
        ]);
        $response = [
            'customer' => $customer,
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
        Customer::where('id', $id)->delete();
        $response = [
            'message' => 'successfully',
        ];
        return  response($response, 200);
    }
}
