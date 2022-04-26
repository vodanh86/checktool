<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';

    protected $casts = [
        'level1_price' =>'json',
    ];

	protected $hidden = [
    ];

	protected $guarded = [];
}
