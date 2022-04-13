<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnitPurchase;
use Auth;

class CreditController extends Controller
{
    public function buy(){
        return view('credits.buy');
    }

    function index(){
        $sum =  UnitPurchase::with('payments')->where('user_id', Auth::user()->id);
        $data['sum'] = $sum;
        $data['history'] = UnitPurchase::with('payments')->where('user_id', Auth::user()->id)->latest()->paginate(3);

        // dd($history);
        return view('credits.history')->with($data); 
    }
}
