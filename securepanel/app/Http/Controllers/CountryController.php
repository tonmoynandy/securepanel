<?php
/******************************************************/
# CountryController                                     #
# Class name     : CountryController                    #
# Functionality:                                        #
#    1. add                                             #
#    2. edit                                            #
#    3. update                                          #
#    4. change status                                   #
# Author         :                                      #
# Created Date   : 24-10-2019                           #
# Purpose        : Country Add, edit, delete, status    #
/*******************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\TranslateCountry;
use DB;
use Image;
use AdminHelper;
class CountryController extends Controller
{
    /****************************************************/
    # Function for country list
    # Function name : index
    # param : countryData, countryDetails
    # Purpose :  country list details
    # Author : 
    # Created Date : 24-10-2019
    # Modified Date : 24-10-2019
    /****************************************************/
    public function index(Request $request) {
		
		
		$countryData = array();
        $countryData['order'] = 'id-D';

        if(!empty($request->order)){
            $countryData['order'] = $request->order;
        }
        $orderField = '';
        $ordeBy = '';
        switch ($countryData['order']) {
            case "id-D":
                $orderField = 'id';
                $ordeBy = 'DESC';
            break;
            case "id-A":
                $orderField = 'id';
                $ordeBy = 'ASC';
            break;
            case "name-D":
                $orderField = 'name';
                $ordeBy = 'DESC';
            break;
            case "name-A":
                $orderField = 'name';
                $ordeBy = 'ASC';
            break;
            case "ccode-D":
                $orderField = 'ccode';
                $ordeBy = 'DESC';
            break;
            case "ccode-A":
                $orderField = 'ccode';
                $ordeBy = 'ASC';
            break;
        }

        $countryDetails = Country::whereRaw('1=1');
        $countryData['srch_text'] = '';
        if (isset($request->srch_text) && trim($request->srch_text) != '') {
            $search = $request->srch_text;
            $countryData['srch_text'] = $request->srch_text;

            $countryDetails->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('ccode', 'LIKE', '%' . $search . '%');
                $query->orWhere('phone_code', 'LIKE', '%' . $search . '%');
                $query->orWhere('currency_code', 'LIKE', '%' . $search . '%');
            });
        }
        $countryData['status'] = '';
        if (isset($request->status) && trim($request->status) != '') {
            $status = $request->status;
            $countryData['status'] = $request->status;
            
            $countryDetails->where(function ($query) use ($status) {
                $query->where('status', '=', $status );
            });
        }
        $countryDetails = $countryDetails->orderBy($orderField, $ordeBy)->paginate(20);
        $countryData['countryDetails'] = $countryDetails;
        $countryData['queryData'] = $request->all();
        return view('country/list',$countryData);

    }
    
    /*****************************************************/
    # CountryController
    # Function name : status
    # Author        :
    # Created Date  : 24-10-2019
    # Purpose       : Changing status of an author
    # Params        : Request $request, $id
    /*****************************************************/
    public function status(Request $request, $id = null)
    {
        if ($id == null) {
            return redirect()->route('secure_country_list');
        }
        $countryDetails = Country::where('id', $id)->first();
        if ($countryDetails != null) {
            if ($countryDetails->status == 1) {
                $countryDetails->status = '0';
                $countryDetails->save();
                return \Redirect::back()->with('success', 'Country status updated successfully');
            } else if ($countryDetails->status == 0) {
                $countryDetails->status = '1';
                $countryDetails->save();
                return \Redirect::back()->with('success', 'Country status updated successfully');
            } else {
                return \Redirect::back()->with('error', 'Something went wrong');
            }
        } else {
            return \Redirect::back()->with('error', 'Invalid author');
        }        
    }


    /****************************************************/
    # Function name : delete
    # param : id
    # Purpose : soft delete country data
    # Author : 
    # Created Date  : 24-10-2019
    /****************************************************/
    public function delete($id)
    {
        
        Country::where('id', $id)->delete();
        return \Redirect::back()->with('success', 'Country status deleted successfully');
        
    }

    /****************************************************/
    # Render add country page
    # Function name : add
    # param :
    # Purpose : add country page render
    # Author : 
    # Created Date : 24-10-2019
    /****************************************************/
    public function add() {

        return view('country/add');

    }
    /****************************************************/
    # Render add country page
    # Function name : save
    # param : country, country_local
    # Purpose : save country data
    # Author : 
    # Created Date : 24-10-2019
    /****************************************************/
    public function save(Request $request)
    {
        if(isset($request->enable_phcode)){
            $this->validate($request, [
            
                'name.*' => 'required|unique:'.(new Country)->getTable().',name|array|min:2',
                'name.*' => 'required|unique:'.(new Country)->getTable().',name|string|min:2',
                'currency_code' => 'required|max:3',
                'ccode' => 'required',
                'phone_code' => 'required|numeric'
                ],
                [
                    'name.AR.required'   => 'Country name in arabic is required',
                    'name.EN.required'   => 'Country name in english is required',
                    'name.EN.unique'   => 'Country name in english already exists',
                    'name.AR.unique'   => 'Country name in arabic already exists',
                    'currency_code'   => 'Currency code is required',
                    'phone_code.required'   => 'Phone code is required',
                    'ccode.required'   => 'Country code is required'

                ]
            );

        }else{
            $this->validate($request, [
            
                'name.*' => 'required|unique:'.(new Country)->getTable().',name|array|min:2',
                'name.*' => 'required|unique:'.(new Country)->getTable().',name|string|min:2',
                'currency_code' => 'required|max:3',
                'ccode' => 'required',
                'phone_code' => 'required|numeric',
                ],
                [
                    'name.AR.required'   => 'Country name in arabic is required',
                    'name.EN.required'   => 'Country name in english is required',
                    'name.EN.unique'   => 'Country name in english already exists',
                    'name.AR.unique'   => 'Country name in arabic already exists',
                    'currency_code'   => 'Currency code is required',
                    'phone_code.required'   => 'Phone code is required',
                    'ccode.required'   => 'Country code is required',

                ]
            );
        }
        
        

        $country = new Country;
        $country->name = $request->name['EN'];
        $country->ccode = $request->ccode;
        $country->phone_code = $request->phone_code; 
        $country->currency_code = strtoupper($request->currency_code);
        $country->enable_phcode = isset($request->enable_phcode)?'1':'0'; 
        $country->status = 1;
        $country->created_at = date('Y-m-d H:i:s');
        $country->updated_at = date('Y-m-d H:i:s');
        $country->save();
        $picture = $request->file('flag_image');
        $pic = $picture;
        if(!empty($picture)) {
            $imagename = time().'.'.$pic->getClientOriginalExtension();
            
            $media = AdminHelper::mediaInsert($picture,'uploads/country_flags', $imagename, '7', $country->id,false, true);

            $country->flag_image_id = $media->id;
            $country->save();
            //==============================

        }
        foreach ($this->lang_locales as $locale) {
            $country_local = new TranslateCountry;
            
            $country_local->country_id = $country->id;
            $country_local->lang_code = $locale['code'];
            $country_local->name = $request->name[$locale['code']];

            $country_local->save();

        }

        return \Redirect::route('secure_country_list')->with('success', 'Country added successfully');

    }

    /****************************************************/
    # Function name : edit
    # param : countryData, country_id, countries
    # Purpose : edit country data
    # Author :
    # Created Date : 24-10-2019
    /****************************************************/
    public function edit(Request $request, $id) {

        $country_id = $id;
        $countryData = array();
        
        $countryData = Country::find($id);

        $country['countryData'] = $countryData;
        $country['localData'] = [];
        foreach($countryData->local as $l) {
            $country['localData'][$l->lang_code] = $l->name; 
        }
        return view('country/edit',$country);

    }

    /****************************************************/
    # Function name : update
    # param : dataLocale, country_id, data
    # Purpose : update country data
    # Author : 
    # Created Date : 24-10-2019
    /****************************************************/
    public function update(Request $request, $id)
    {
        //dd($request);
        $country_id = $id;
        if(isset($request->enable_phcode)){
            $this->validate($request, [
            
                'name.*' => 'required|array|min:2',
                'name.*' => 'required|min:2',
                'currency_code' => 'required|max:3',
                'ccode' => 'required',
                'phone_code' => 'required|numeric',
                ],
                [
                    'name.AR.required'   => 'Country name in arabic is required',
                    'name.EN.required'   => 'Country name in english is required',
                    'currency_code'   => 'Currency code is required',
                    'phone_code.required'   => 'Phone code is required',
                    'ccode.required'   => 'Country code is required'

                ]
            );

        }else{
            $this->validate($request, [
            
                'name.*' => 'required|min:2',
                'name.*' => 'required|min:2',
                'currency_code' => 'required|max:3',
                'ccode' => 'required',
                'phone_code' => 'required|numeric',
                ],
                [
                    'name.AR.required'   => 'Country name in arabic is required',
                    'name.EN.required'   => 'Country name in english is required',
                    'currency_code'   => 'Currency code is required',
                    'phone_code.required'   => 'Phone code is required',
                    'ccode.required'   => 'Country code is required',

                ]
            );
        }
        
        

        $country = Country::find($country_id);
        $country->name = $request->name['EN'];
        $country->ccode = $request->ccode;
        $country->phone_code = $request->phone_code; 
        $country->currency_code = strtoupper($request->currency_code);
        $country->enable_phcode = isset($request->enable_phcode)?'1':'0'; 
        $country->status = 1;
        $country->created_at = date('Y-m-d H:i:s');
        $country->updated_at = date('Y-m-d H:i:s');
        $country->save();
        $picture = $request->file('flag_image');
        $pic = $picture;
        if(!empty($picture)) {
            @unlink(public_path('uploads/country_flags/'.$country->flagImage->media_value));
            $imagename = time().'.'.$pic->getClientOriginalExtension();
            
            $media = AdminHelper::mediaInsert($picture,'uploads/country_flags', $imagename, '7', $country->id,false, true);

            $country->flag_image_id = $media->id;
            $country->save();
            //==============================

        }
        TranslateCountry::where('country_id', $country_id)->delete();
        foreach ($this->lang_locales as $locale) {
            $country_local = new TranslateCountry;
            
            $country_local->country_id = $country->id;
            $country_local->lang_code = $locale['code'];
            $country_local->name = $request->name[$locale['code']];

            $country_local->save();

        }

        return \Redirect::route('secure_country_list')->with('success', 'Country is updated successfully');

    }
}
