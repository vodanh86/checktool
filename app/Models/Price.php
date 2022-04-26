<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';

    protected $casts = [
        'level1_price' =>'json',
        'level2_price' =>'json',
        'level3_price' =>'json',
        'level4_price' =>'json',
    ];

	protected $hidden = [
    ];

	protected $guarded = [];
}
