<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group',
        'case_config',
        'unit_price',
        'lower_limit',
        'upper_limit',
    ];
}
