<?php

use App\Models\Currency;
use Illuminate\Support\Facades\Session;

function currencyValue()
{
    if(Session::has('currency'))
    {
        $value = Currency::findOrFail(Session::get('currency'))->value;
        
    }else{
        $value = Currency::where('is_default', 1)->first()->value;
        
    }

    return $value;
}

function currencySign()
{
    if(Session::has('currency'))
    {
        $sign = Currency::findOrFail(Session::get('currency'))->sign;
        
    }else{
        $sign = Currency::where('is_default', 1)->first()->sign;
       
    }

    return $sign;
}