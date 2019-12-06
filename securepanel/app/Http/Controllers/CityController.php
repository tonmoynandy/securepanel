<?php

/******************************************************/
# CityController                                       #
# Class name     : CityController                      #
# Functionality:                                        #
#    1. add                                             #
#    2. edit                                            #
#    3. update                                          #
#    4. change status                                   #
#    5. delete                                          #
# Author         :                                      #
# Created Date   : 25-10-2019                           #
# Purpose        : City Add, edit, delete              #
/*******************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\TranslateCity;
use App\Country;
use App\State;
use Session;
use DB;
use AdminHelper;


class CityController extends Controller
{
    
	/*
    |--------------------------------------------------------------------------
    | City Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the city add ,edit, delete.
    | This controller use for to add new city.
    | 
    |
    */



    /****************************************************/
    # Function name : index
    # param : cityData, cityDetails
    # Purpose : list city
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function index(Request $request) {
		
		$cityData = array();
		$cityData['pageTitle']  = 'Cities';
        $cityData['panelTitle'] = 'Cities';
        $cityData['order'] = 'id-D';

        if(!empty($request->order)){
            $cityData['order'] = $request->order;
        }
        $orderField = '';
        $ordeBy = '';
        switch ($cityData['order']) {
            case "id-D":
                $orderField = 'cities.id';
                $ordeBy = 'DESC';
            break;
            case "id-A":
                $orderField = 'cities.id';
                $ordeBy = 'ASC';
            break;
            case "name-D":
                $orderField = 'cities.name';
                $ordeBy = 'DESC';
            break;
            case "name-A":
                $orderField = 'cities.name';
                $ordeBy = 'ASC';
            break;
            
        }

        $cityDetails = City::where('deleted_at', NULL);
        $stateData['srch_text'] = '';
        if (isset($request->srch_text) && trim($request->srch_text) != '') {
            $search = $request->srch_text;
            $stateData['srch_text'] = $request->srch_text;

            $cityDetails->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        $cityData['selectedCountries'] = [];
        if(isset($request->searchcountry) && !empty($request->searchcountry)){
            $cityData['selectedCountries'] = $request->searchcountry;
            $search = $request->searchcountry;
            $cityDetails->where(function ($query) use ($search) {
                $query->where('country_id','=', $search );
            });
        }

        $cityData['selectedStates'] = [];
        if(isset($request->searchstate) && !empty($request->searchstate)){
            $cityData['selectedStates'] = $request->searchstate; 
            $search = $request->searchstate;
            $cityDetails->where(function ($query) use ($search) {
                $query->where('state_id','=',  $search );
            });
        }

        $stateData['status'] = '';
        if (isset($request->status) && trim($request->status) != '') {
            $status = $request->status;
            $stateData['status'] = $request->status;
            
            $stateDetails->where(function ($query) use ($status) {
                $query->where('status', '=', $status );
            });
        }

        $cityDetails = $cityDetails->orderBy($orderField, $ordeBy)->paginate(AdminHelper::ADMIN_AUTHOR_LIMIT);
       
        $cityData['cityDetails'] = $cityDetails;
        $cityData['queryData']   = $request->all();

       if(isset($cityData['queryData']['searchstate'])){
        $cityData['searchstate'] = $cityData['queryData']['searchstate'][0];
       } else {
       	$cityData['searchstate'] = '';
       }
        $cityData['all_countries'] = Country::pluck('name', 'id')->toArray();
        $cityData['all_states'] = State::pluck('name', 'id')->toArray();

        return view('city/list',$cityData);
	}



	/****************************************************/
    # Function name : add
    # param : countryDetails
    # Purpose : render add city page
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function add() {
    	$data['pageTitle']  = 'City Add';
        $data['panelTitle'] = 'Add City';

        $countryDetails = Country::where('status',1)->where('deleted_at',NULL)->get();
        //$stateDetails   = State::where('status',1)->where('deleted_at',NULL)->get();

        $data['countryDetails'] = $countryDetails;
        return view('city/add',$data);

    }


    /****************************************************/
    # Function name : save
    # param : city
    # Purpose : save city data
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function save(Request $request) {
        $this->validate($request, [
            
            'name.*' => 'required|string|min:2',
            ],
            [
                'name.AR.required'   => 'City name in arabic is required',
                'name.EN.required'   => 'City name in english is required',
                'name.EN.unique'     => 'City name in english already exists',
                'name.AR.unique'     => 'City name in arabic already exists',

            ]
        );

        $city 			   = new City;
        $city->name 	   = $request->name['EN'];
        $city->country_id  = $request->country;
        $city->state_id    = $request->state;
        $city->status 	   = 1;
        $city->created_at  = date('Y-m-d H:i:s');
        $city->updated_at  = date('Y-m-d H:i:s');
        $city->save();
        
        foreach ($this->lang_locales as $locale) {
            $city_local             = new TranslateCity;
            $city_local->city_id    = $city->id;
            $city_local->lang_code  = $locale['code'];
            $city_local->name       = $request->name[$locale['code']];
            $city_local->save();
        }

        session()->flash('message', 'City added successfully');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('city/list');
    }



    /****************************************************/
    # Function name : edit
    # param : Request $request, $id
    # Purpose : edit city data
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function edit(Request $request, $id) {
    	
        $city_id = $id;
        $cityData = array();
        
        $cityData['countryDetails'] = Country::where('status',1)->where('deleted_at',NULL)->get();
        
        $cityData['cities'] = City::where('id', $city_id)->first();
        $cityData['pageTitle']  = 'City Edit';
        $cityData['panelTitle'] = 'Edit City';

        $cityData['localData'] = [];
        foreach($cityData['cities']->local as $l) {
            $cityData['localData'][$l->lang_code] = $l->name; 
        }
        return view('city/edit',$cityData);

    }



    /****************************************************/
    # Function name : update
    # param : Request $request ,$id
    # Purpose : update city data
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function update(Request $request ,$id) {
        
        $this->validate($request, [
            'country'=>'required',
            'name.*' => 'required|array|min:2',
            'name.*' => 'required|string|min:2',
            ],
            [
                'country'=>'Country is required',
                'name.AR.required'   => 'State name in arabic is required',
                'name.EN.required'   => 'State name in english is required',

            ]
        );

        $city = City::find($id);
        $city->name = $request->name['EN'];
        $city->country_id = $request->country;
        $city->status = '1';
        $city->save();
        TranslateCity::where('city_id',$id)->delete();

        foreach ($this->lang_locales as $locale) {
            $city_local = new TranslateCity;
            $city_local->city_id = $city->id;
            $city_local->lang_code = $locale->code;
            $city_local->name = $request->name[$locale->code];
            $city_local->save();
        }

        return \Redirect::back()->with('success', 'City is updated successfully');

    }


    /****************************************************/
    # Function name : delete
    # param : id
    # Purpose : soft delete city
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function delete($id) {
        try {
	        City::where('id', $id)->delete();
	        session()->flash('message', 'City deleted successfully');
	        Session::flash('alert-class', 'alert-success'); 
	        return redirect('city/list');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'Some error occured during delete city');
            Session::flash('alert-class', 'alert-danger');
          return redirect('city/list');
        }
    }


    /****************************************************/
    # Function name : changeStatus
    # param : city
    # Purpose : city active/inactive
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function changeStatus(Request $request, $id){
        
        try {
            $city = City::find($id);
            
            if($city->status == 1)
            {
                $status = 0;
            } 
            else 
            {
                $status = 1;
            }
            $city->status = $status;
            $city->save();
            
        
            session()->flash('message', 'City status update successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('city/list');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'Some error occured during city status update');
            Session::flash('alert-class', 'alert-danger');
          return redirect('city/list');
        }
    }



    /****************************************************/
    # Function name : stateList
    # param : Request $request
    # Purpose : get state list with respect to country
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function stateList(Request $request) {
        $stateList = AdminHelper::getCountrySpecificState($request->country_id);
        return $stateList;
    }

}
