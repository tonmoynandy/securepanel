<?php
/******************************************************/#
# Class name     : HomeController                       #
# Functionality:                                        #
#    1. index                                           #
#    2. loginAction                                     #
#    3. logout                                          #
# Author         :                                      #
# Created Date   : 22-10-2019                           #
# Purpose        : login, logout  , forget password                     #
/*******************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
/*****************************************************/
    # Function name : index
    # Author        :
    # Created Date  : 21-10-2019
    # Purpose       : render login page
    # Params        :
    /*****************************************************/
    public function index()
    {
        return view('index');
    }
/*****************************************************/
    # Function name : loginAction
    # Author        :
    # Created Date  : 22-10-2019
    # Purpose       : login action
    # Params        :
    /*****************************************************/
    public function loginAction(Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        if (!$validator->fails()) {
            $credentials = $request->only('email', 'password');
            if (\Auth::attempt($credentials)) {
                return \Redirect::route('secure_dashboard');
            } else {
                return \Redirect::back()->with('error', 'Login failed: Credentials mismatch');
            }
        } else {
            return \Redirect::back()->withErrors($validator);
        }

    }
/*****************************************************/
    # Function name : logout
    # Author        :
    # Created Date  : 22-10-2019
    # Purpose       : render logout
    # Params        :
    /*****************************************************/
    public function logout()
    {
        \Session::flush();
        return \Redirect::route('home');

    }

/*****************************************************/
    # Function name : forgetPassword
    # Author        :
    # Created Date  : 22-10-2019
    # Purpose       : render forget password
    # Params        : Request $request
    /*****************************************************/
    public function forgetPassword()
    {
        return view('forget_password');
    }
/*****************************************************/
    # Function name : forgetPasswordAction
    # Author        :
    # Created Date  : 22-10-2019
    # Purpose       : forget password action
    # Params        : Request $request
    /*****************************************************/
    public function forgetPasswordAction(Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
                'email' => 'required|email',
            ]
        );
        if (!$validator->fails()) {
            $user = \App\AdminUsers::where('email', $request->email)->first();
            if ($user) {
                $newPassword = 'Numou@9102';
                $user->password = $newPassword;
                $user->save();
                $data['password'] = $newPassword;
                $data['username'] = $user->name;

                \Mail::send('email_template.forget_password', $data, function($message) use ($user) {
 
                    //$message->to($user->email, $user->name)
                    $message->to('harrypotter@yopmail.com', 'Harry Potter')
                    ->subject('Numou::Forget Password');
                });
         
                if (\Mail::failures()) {
                   return \Redirect::back()->with('error', 'Sorry! Please try again latter');
                 }else{
                    return \Redirect::back()->with('success', 'Please check your email inbox for new password');
                 }
            }else {
                return \Redirect::back()->with('error', 'Email is not exists in our system');
            }
        } else {
            return \Redirect::back()->withErrors($validator);
        }
    }
    
}
