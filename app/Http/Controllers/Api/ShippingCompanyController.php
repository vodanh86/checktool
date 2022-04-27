<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShippingCompany;
use App\Http\Resources\ShippingCompanyResource;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ShippingCompany = ShippingCompany::all();
        return (new ShippingCompanyResource($ShippingCompany))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingCompany  $shippingCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingCompany $shippingCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingCompany  $shippingCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingCompany $shippingCompany)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingCompany  $shippingCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingCompany $shippingCompany)
    {
        //
    }
}
