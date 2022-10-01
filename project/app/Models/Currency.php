<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'sign', 'is_default', 'value'
    ];

}
