<?php
/******************************************************/ 
# Class name     : CmsController                  		#
# Functionality:                                        #
#    1. index                                           #
#	 2. edit 											#
#    3. update                                          #
#    4. status                                          #
# Author         :                                      #
# Created Date   : 23-10-2019                           #
# Purpose        : CMS management                       #
/*******************************************************/
namespace App\Http\Controllers;

use App\Cms;
use App\Http\Helpers\AdminHelper;
use App\Media;
use App\TranslateCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CmsController extends Controller
{
	/*****************************************************/
   	# CmsController
   	# Function name : index
   	# Author        :
   	# Created Date  : 23-10-2019
   	# Purpose       : Show the list of the cms
   	# Params        : 
	/*****************************************************/ 
	public function index() {
        $data['order_by']   = 'created_at';
        $data['order']      = 'desc';
    	$data['allCms'] = Cms::orderBy($data['order_by'], $data['order'])
                                ->paginate(AdminHelper::ADMIN_PAGINATION_LIMIT);  									
    	return view('cms/list', $data);
    }
    /*****************************************************/
   	# CmsController
   	# Function name : edit
   	# Author        :
   	# Created Date  : 23-10-2019
   	# Purpose       : Show the details of particular cms page
   	# Params        : Request $request, $id:integer
    /*****************************************************/ 
    public function edit(Request $request, $id) {
    	$data['allCms'] = Cms::where('id',$id)->with('translateCms')->first();	
    	return view('cms/edit', $data);
    }
    /*****************************************************/
   	# CmsController
   	# Function name : update
   	# Author        :
   	# Created Date  : 23-10-2019
   	# Purpose       : Show the details of particular cms page
   	# Params        : Request $request, $id:integer
    /*****************************************************/ 
    public function update(Request $request, $id) {
    	$languages = AdminHelper::getLanguages();
    	foreach ($languages as $language) {
    		$validationCondition[$language['name'].'.*'] = 'required';
    	}
    	$validator = \Validator::make($request->all(), $validationCondition);
    	if ($validator->fails()) {
    		return \Redirect::back()->withErrors($validator)->withInput();
    	} else {
    		$updateData = $request->all();
    		unset($updateData['_token']);
    		$updateData = array_values($updateData);
    		$masterData = $updateData[0];

            $cmsDetails = Cms::where('id', $id)->first();
            $cmsDetails->title   = trim($masterData['title'], ' ');
            $cmsDetails->slug    = AdminHelper::generateUniqueSlug(new Cms, trim($masterData['title'], ' '), $id);
            $cmsDetails->save();

    		foreach($updateData as $data){
    			$cmsTranslateData = TranslateCms::where(array(
    				'page_id' 	=> $id,
    				'lang_code' => $data['lang_code']
    			))->first();
    			$cmsTranslateData->title = $data['title'];
    			$cmsTranslateData->description = $data['description'];
    			$cmsTranslateData->meta_title = $data['meta_title'];
    			$cmsTranslateData->meta_description = $data['meta_description'];
    			$cmsTranslateData->save();

    			if(isset($data['image'])) {

    				$elementId = $cmsTranslateData->id;
    				$cmsImage = Media::where(array(
                                            'element_id' => $elementId,
                                            'type' => AdminHelper::MEDIA_CMS
                                        ))->first();
    				if($cmsImage){
                        /******* set image path for unlink image ***********/
    					$imagePath = public_path('/uploads/cms_banner/'.$cmsImage->media_value); 
                        /******* if file exist then unlink image ***********/ 
    					if (file_exists($imagePath)) {
					       	unlink($imagePath);
					   	}
                        $picture = $data['image'];
                        $pic = $picture;
                        if(!empty($picture)) {
                            $imagename  = 'cms_'.strtotime(date('Y-m-d H:i:s')). '_'.$pic->getClientOriginalName();
                            $media     = AdminHelper::mediaInsert($picture,'uploads/cms_banner', $imagename, AdminHelper::MEDIA_CMS, $elementId,false, true);
                            $cmsTranslateData->banner_id = $media->id;
                            $cmsTranslateData->save();
                        }    					
    				} else {
                        $picture = $data['image'];
                        $pic = $picture;
                        if(!empty($picture)) {
                            $imagename  = 'cms_'.strtotime(date('Y-m-d H:i:s')). '_'.$pic->getClientOriginalName();
                            $media     = AdminHelper::mediaInsert($picture,'uploads/cms_banner', $imagename, AdminHelper::MEDIA_CMS, $elementId,false, true);
                            $cmsTranslateData->banner_id = $media->id;
                            $cmsTranslateData->save();
                        }
    				}	                
	                $cmsTranslateData->banner_id = $cmsImage->id;
	            	$cmsTranslateData->save();
	            }
    		}
    		return Redirect::back()->with('success', 'Cms details updated successfully');
    	}
    }
    /*****************************************************/
    # CmsController
    # Function name : status
    # Author        :
    # Created Date  : 23-10-2019
    # Purpose       : Changing status of cms
    # Params        : Request $request, $id
    /*****************************************************/
    public function status(Request $request, $id)
    {
    	if ($id == null) {
    		return Redirect::Route('secure_cms_list');
    	}
    	$cmsDetails = Cms::where('id', $id)->first();
    	if ($cmsDetails) {            
    		$cmsDetails->status = ($cmsDetails->status == '1')? '0':'1';
    		$cmsDetails->save();
    		return Redirect::Route('secure_cms_list')->with('success', 'Cms status updated successfully');
    	} else {
    		return Redirect::Route('secure_cms_list')->with('error', 'Invalid cms');
    	}
    }
}
