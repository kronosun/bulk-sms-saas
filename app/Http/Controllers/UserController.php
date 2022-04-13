<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserRegisterMail;
use Mail;
use Auth;

use App\User;

class UserController extends Controller
{

    function __construct(){
        
    }
    // public function emailVerification(){
    //     return view('auth.verify_email');
    // }

    public function resendVerificationMail(Request $request){
        $user = Auth::user();
        Mail::to($user->email)->send(new UserRegisterMail($user));
        Session(['email'=>$user->email]);
        Session(['alert'=>'success', 'msg'=>'verification link resent']);
        return redirect(url('email/verify'));
    }


    public function verifyEmail(Request $request){
        if (!$request->email || !$request->code) {
           die('invalid verification link');
        }
        $email = clean($request->email);
        $code  = clean($request->code);
        $user = User::where(['email'=>$email, 'verification_code'=>$code])->first();
        if (is_null($user)) {
            die('invalid verification link');
        }
        if ($user->verified_expiry_date<time()) {

           Session(['email'=>$email, 'alert'=>'danger', 'msg'=>'verification link expired. we have resent a new link just now.']);
           return redirect(url('email/verify'));
        }

        $user->email_verified_at = date('Y-m-d h:m:i', time());
        $user->save();
        
        Session(['msg'=>'Email Successfully verified', 'alert'=>'success']);
    
        return redirect('home');
        // 2021-12-10 08:26:24
    }
}
