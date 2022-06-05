<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserRegisterMail;
use Mail;
use App\Mail\PasswordResetMail;
use Auth;
use App\PasswordReset;
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
        $user->verification_code = sha1(\Str::random('7'));
        $user->verified_expiry_date = strtotime('+3 days');
        $user->save();
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

    public function sendPasswordResetLink(Request $request){

        $request->validate([
            'email'=>'required'
        ]);

        $email = clean($request->email);
        $user = User::where('email', $email)->first();
        if($user){
             PasswordReset::where('email', $user->email)->delete();
             $passwordReset = new PasswordReset();
             $passwordReset->email = $user->email;
             $passwordReset->token = \Str::random(30);
             $passwordReset->expiry = strtotime(env('PASSWORD_RESET_EXPIRY'));
             $passwordReset->save();
             Mail::to($passwordReset->email)->send(new PasswordResetMail($passwordReset));

        }
      
        return redirect()->route('password-reset-feedback');
        
    }

    public function PasswordResetFeedBack(){
      return view('auth.password-reset-feedback');
    }

    public function PasswordReset(Request $request){
      $email = clean($request->email);
      $token = clean($request->token);
      // dd($token);
      
      $passwordReset = PasswordReset::where(['email'=>$email, 'token'=>$token])->where('expiry', '>', time())->first();
      if(!$passwordReset){
         return view('error.invalid-link');
      }
      Session(['email'=>$email]);
      return view('auth.change-password');

   }

    public function changePassword(Request $request){
      $request->validate([
         'password'=>'required|confirmed|min:8',
      ]);
      

      $user = User::where('email', session('email'))->first();
      $user->password = \Hash::make($request->password);
      $user->save();
      Session(['msg'=>'Password reset successful. Login to proceed', 'alert'=>'info']);
      session()->forget('email');
      return redirect('login');
   }
}
