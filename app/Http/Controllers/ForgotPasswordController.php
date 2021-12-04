<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {

       return view('auth.password.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('front.auth.password.verify',['token' => $token], function($message) use ($request) {
                  $message->from($request->email);
                  $message->to($request->email);
                  $message->subject('Reset Password Notification');
               });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

}
