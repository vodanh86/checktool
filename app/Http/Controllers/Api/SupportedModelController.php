<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupportedModel;
use App\Http\Resources\SupportedModelResourceCollection;
use App\Http\Resources\SupportedModelResource;
use Illuminate\Http\Request;

class SupportedModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supportedModel = SupportedModel::all();
        return (new SupportedModelResourceCollection($supportedModel))->response();
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
     * @param  \App\Models\SupportedModel  $supportedModel
     * @return \Illuminate\Http\Response
     */
    public function show(SupportedModel $supportedModel)
    {
        return (new SupportedModelResource($supportedModel))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupportedModel  $supportedModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportedModel $supportedModel)
    {
        //
    }

    public function check(Request $request)
    {
        if ($request->get('type') && $request->get('model')){
            $supportedModel = SupportedModel::where('type', 'like', '%' . $request->get('type') . '%')->where('model', 'like', $request->get('model'))->first();
            if ($supportedModel) {
                return $supportedModel->status;
            }
        }
        return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportedModel  $supportedModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportedModel $supportedModel)
    {
        //
    }
}
