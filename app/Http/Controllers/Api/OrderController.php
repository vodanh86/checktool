<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SupportedModel;
use App\Http\Resources\OrderResourceCollection;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|max:255|email|unique:users,email',
            'password' => 'bail|required|string|min:8'
        ]);*/
        $order = new Order();
        $supportedModel = SupportedModel::where('model', 'like', '%' . $request->get('model') . '%')->first();
        if ($supportedModel){
            $order->model_id = $supportedModel->id;
            $order->type = $supportedModel->type;
        }
        $order->phone_number = $request->input('phone_number');
        $order->storage = $request->input('storage');
        $order->battery = $request->input('battery');
        $order->screen = $request->input('screen');
        $order->case = $request->input('case');
        $order->keyboard = $request->input('keyboard');
        $order->ring_tone = $request->input('ring_tone');
        $order->finger_print = $request->input('finger_print');
        $order->sim_tray = $request->input('sim_tray');
        $order->home = $request->input('home');
        $order->face_id = $request->input('face_id');
        $order->touch_3d = $request->input('touch_3d');
        $order->true_tone = $request->input('true_tone');
        $order->charger = $request->input('charger');
        $order->wireless_charger = $request->input('wireless_charger');
        $order->cellphone_wave = $request->input('cellphone_wave');
        $order->wifi = $request->input('wifi');
        $order->speaker = $request->input('speaker');
        $order->microphone = $request->input('microphone');
        $order->front_camera = $request->input('front_camera');
        $order->back_camera = $request->input('back_camera');
        $order->calling_sensor = $request->input('calling_sensor');
        $order->light_sensor = $request->input('light_sensor');
        $order->compass_sensor = $request->input('compass_sensor');
        $order->headphone = $request->input('headphone');
        $order->price = $request->input('price');
        $order->bank_name = $request->input('bank_name');
        $order->bank_account = $request->input('bank_account');
        $order->shipping_company = $request->input('shipping_company');
        $order->address = $request->input('address');
        $order->province = $request->input('province');
        $order->district = $request->input('district');
        $order->commune = $request->input('commune');
        $order->save();

        $order->order_code = "TELINK" . $order->id;
        $order->save();
        return (new OrderResource($order))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return (new OrderResource($order))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
