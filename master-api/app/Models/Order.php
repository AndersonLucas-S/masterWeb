<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['description'];

    protected $casts = [
        'description' => 'json',
    ];
}
