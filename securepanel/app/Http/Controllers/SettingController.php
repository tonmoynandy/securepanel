<?php
/*******************************************************/ 
# Class name     : SettingController                	#
# Functionality:                                        #
#    1. index                                           #
#	 2. update 											#
# Author         :                                      #
# Created Date   : 24-10-2019                           #
# Purpose        : Site Settings management             #
/*******************************************************/
namespace App\Http\Controllers;

use App\SiteSetting;
use App\Http\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    /*****************************************************/
   	# SettingController
   	# Function name : index
   	# Author        :
   	# Created Date  : 24-10-2019
   	# Purpose       : Show the list of the all settings
   	# Params        : 
	/*****************************************************/ 
	public function index() {
    	$data['allSettings'] = SiteSetting::all();  											
    	return view('site_settings', $data);
    }
    /*****************************************************/
   	# SettingController
   	# Function name : update
   	# Author        :
   	# Created Date  : 24-10-2019
   	# Purpose       : update site settings
   	# Params        : Request $request, $id:integer
    /*****************************************************/ 
    public function update(Request $request, $id) {
        $validator = \Validator::make($request->all(),
		    ['param_value' => 'required'],
		    ['param_value.required' => 'This field is required.']
        );

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }else{
        	$settingData = SiteSetting::where('id', $id)->first();
        	if($settingData){
        		if($request->file('image')){
        			$image = $request->file('image');
                    /******* set image path for unlink image ***********/
    				$image_path = public_path('/uploads/site_setting/'.$settingData->param_value);
                    /*********** if file exist then unlink image ***********/ 
    				if (file_exists($image_path)) {
    			       	unlink($image_path);
    			   	}
    			   	$filename 	= 'setting_'.strtotime(date('Y-m-d H:i:s')). '_'.$image->getClientOriginalName();
                    $extension 	= pathinfo($filename, PATHINFO_EXTENSION);
                    if(in_array($extension,AdminHelper::UPLOADED_IMAGE_FILE_TYPES)) {
                    	$destinationPath = public_path('/uploads/site_setting');
    			   		$image->move($destinationPath, $filename);
                        $settingData->param_value 	= $filename;
                        $settingData->save();    
                    } else {
                        return Redirect::back()->with('error', 'File extention error');
                    }
    	    	}else{
    	    		$paramValue = $request->param_value;
    	    		$settingData->param_value = $paramValue;
                    $settingData->save();
    	    	}
    	    	return Redirect::back()->with('success', 'Site settings updated successfully');
        	} else {
        		return Redirect::Route('secure_settings_list')->with('error', 'Invalid Settings');
        	}
        }
    }
}
