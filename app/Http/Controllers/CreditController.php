<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function buy(){
        return view('credits.buy');
    }
}
