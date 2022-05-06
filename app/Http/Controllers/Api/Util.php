<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\SupportedModel;
use App\Models\Price;

final class Util {

    static function checkPrice($request){
        if ($request->get('type') && $request->get('model')){
            $supportedModel = SupportedModel::where('type', 'like', '%' . $request->get('type') . '%')->where('model', 'like', '%' . $request->get('model') . '%')->first();
            if ($supportedModel){
                $price = Price::where('model_id', $supportedModel->id)->first();
                if ($price) {
                    return $price->level1_price;
                }
            }
        }
        return "";
    }

}