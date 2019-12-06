<?php
/******************************************************/                                   #
# Class name     : DashboardController                       #
# Functionality:                                        #
#    1. index                                           #
# Author         :                                      #
# Created Date   : 22-10-2019                           #
# Purpose        : dashboard                            #
/*******************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
/*
    NAME : index
    METHOD : GET
    PERPOUS : render dashboard page
    
*/ 
    public function index() {
        return view('dashboard');
    }
}
