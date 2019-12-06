<?php
/******************************************************/                                   #
# Class name     : ProfileController                       #
# Functionality:                                        #
#    1. index                                           #
# Author         :                                      #
# Created Date   : 22-10-2019                           #
# Purpose        : profile                              #
/*******************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
/*
    NAME : index
    METHOD : GET
    PERPOUS : render profile page 
    
*/     
    public function index(Request $request) {
        $data['userdata'] = \Auth::user();
        return view('profile', $data);
    }

    public function changePasswordAction(Request $request) {
        $validator = \Validator::make($request->all(), [
            'old_password'=>'required',
            'new_password'=>'required',
            'new_confirm_password'=>'required|same:new_password',
        ]);
        if (!$validator->fails()) {
            if (\Hash::check($request->old_password, \Auth::user()->password)) {
                $user = \Auth::user();
                $user->password = $request->new_password;
                $user->save();
                return \Redirect::back()->with('password_success','Password is changed successfully');    
            } else {
                return \Redirect::back()->with('password_old_error','Old password is not matching');    
            }
        } else {
            return \Redirect::back()->with('passwordErr','true')->withErrors($validator);
        }
    }
}
