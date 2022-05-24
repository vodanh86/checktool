<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\SupportedModel;
use App\Models\Price;

final class Util {

    static function getIphoneStorage($storage){
        if ($storage < 32) return 32;
        if ($storage < 64) return 64;
        if ($storage < 128) return 128;
        if ($storage < 256) return 256;
        if ($storage < 512) return 512;
        return 1028;
    }

    static function checkPrice($request){
        if ($request->get('type') && $request->get('model')){
            $supportedModel = SupportedModel::where('type', 'like', '%' . $request->get('type') . '%')->where('model', 'like', '%' . $request->get('model') . '%')->first();
            if ($supportedModel){
                $price = Price::where('model_id', $supportedModel->id)->first();
                $countComponents = 0;
                if ($request->input('crew') != "1") $countComponents += 3;
                if ($request->input('screen') != "1") $countComponents ++;
                if ($request->input('case') != "1") $countComponents ++;
                if ($request->input('keyboard') != "1") $countComponents ++;
                if ($request->input('diaphragm') != "1") $countComponents ++;
                if ($request->input('charging_port') != "1") $countComponents ++;
                if ($request->input('finger_print') != "1") $countComponents ++;
                if ($request->input('sim_tray') != "1") $countComponents ++;
                if ($request->input('home') != "1") $countComponents ++;
                if ($request->input('face_id') != "1") $countComponents ++;
                if ($request->input('touch_3d') != "1") $countComponents ++;
                if ($request->input('true_tone') != "1") $countComponents ++;
                if ($request->input('charger') != "1") $countComponents ++;
                if ($request->input('wireless_charger') != "1") $countComponents ++;
                if ($request->input('cellphone_wave') != "1") $countComponents ++;
                if ($request->input('wifi') != "1") $countComponents ++;
                if ($request->input('speaker') != "1") $countComponents ++;
                if ($request->input('microphone') != "1") $countComponents ++;
                if ($request->input('front_camera') != "1") $countComponents ++;
                if ($request->input('back_camera') != "1") $countComponents ++;
                if ($request->input('calling_sensor') != "1") $countComponents ++;
                if ($request->input('light_sensor') != "1") $countComponents ++;
                if ($request->input('rotation_sensor') != "1") $countComponents ++;
                if ($request->input('compass_sensor') != "1") $countComponents ++;
                if ($request->input('headphone') != "1") $countComponents ++;
                if ($request->input('tone_speaker') != "1") $countComponents ++;
                if ($request->input('recording_microphone') != "1") $countComponents ++;
                if ($request->input('front_microphone') != "1") $countComponents ++;
                if ($request->input('back_microphone') != "1") $countComponents ++;
                if ($price) {
                    if ($countComponents == 0) return $price->level1_price;
                    if ($countComponents == 1) return $price->level2_price;
                    if ($countComponents == 2) return $price->level3_price;
                    return $price->level4_price;
                }
            }
        }
        return "";
    }

}