<?php

/******************************************************/
# StateController                                       #
# Class name     : StateController                      #
# Functionality:                                        #
#    1. add                                             #
#    2. edit                                            #
#    3. update                                          #
#    4. change status                                   #
#    5. delete                                          #
# Author         :                                      #
# Created Date   : 25-10-2019                           #
# Purpose        : State Add, edit, delete              #
/*******************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\TranslateState;
use App\Country;
use Session;
use DB;


class StateController extends Controller
{
    
	/*
    |--------------------------------------------------------------------------
    | State Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the state add ,edit, delete.
    | This controller use for to add new state.
    | 
    |
    */



    /****************************************************/
    # Function name : index
    # param : stateData, stateDetails
    # Purpose : list state
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function index(Request $request) {
		
		
		$stateData = array();
        $stateData['order'] = 'id-D';

        if(!empty($request->order)){
            $stateData['order'] = $request->order;
        }
        $orderField = '';
        $ordeBy = '';
        switch ($stateData['order']) {
            case "id-D":
                $orderField = 'states.id';
                $ordeBy = 'DESC';
            break;
            case "id-A":
                $orderField = 'states.id';
                $ordeBy = 'ASC';
            break;
            case "name-D":
                $orderField = 'states.name';
                $ordeBy = 'DESC';
            break;
            case "name-A":
                $orderField = 'states.name';
                $ordeBy = 'ASC';
            break;
            
        }

        $stateDetails = State::where('deleted_at', NULL);
        $stateData['srch_text'] = '';
        if (isset($request->srch_text) && trim($request->srch_text) != '') {
            $search = $request->srch_text;
            $stateData['srch_text'] = $request->srch_text;

            $stateDetails->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        $stateData['selectedCountries'] = [];
        if(isset($request->searchcountry) && !empty($request->searchcountry)){
            $stateData['selectedCountries'] = $request->searchcountry;
            $search = $request->searchcountry;
            $stateDetails->where(function ($query) use ($search) {
                $query->where('country_id','=',$search );
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
        $stateDetails = $stateDetails->orderBy($orderField, $ordeBy)->paginate(10);
        $stateData['stateDetails'] = $stateDetails;
        $stateData['queryData'] = $request->all();
        $stateData['all_countries'] = Country::pluck('name', 'id')->toArray();;
        return view('state/list',$stateData);

	}

	/****************************************************/
    # Function name : add
    # param : countryDetails
    # Purpose : render add state page
    # Author : 
    # Created Date : 25-10-2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function add() {

        
        $countryDetails = Country::where('status',1)->where('deleted_at',NULL)->get();

        return view('state/add',compact('countryDetails'));

    }
    /****************************************************/
    # Function name : save
    # param : state
    # Purpose : save state data
    # Author : 
    # Created Date : 21/01/2019
    # Modified Date : 25-10-2019
    /****************************************************/
    public function save(Request $request)
    {
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

        $state = new State;
        $state->name = $request->name['EN'];
        $state->country_id = $request->country;
        $state->status = '1';
        $state->save();
        
        foreach ($this->lang_locales as $locale) {
            $state_local = new TranslateState;
            $state_local->state_id = $state->id;
            $state_local->lang_code = $locale->code;
            $state_local->name = $request->name[$locale->code];
            $state_local->save();

        }

        return \Redirect::route('secure_state_list')->with('success', 'State added successfully');

    }

    /****************************************************/
    # Function name : edit
    # param : state_id, stateData, states, countryDetails,selectedCountries
    # Purpose : edit state data
    # Author : 
    # Created Date : 21/01/2019
    # Modified Date : 21/01/2019
    /****************************************************/
    public function edit(Request $request, $id) {

        $state_id = $id;
        $stateData = array();
        
       

           // dd($states);
        $stateData['countryDetails'] = Country::where('status',1)->where('deleted_at',NULL)->get();
        
        $stateData['states'] = State::where('id', $state_id)->first();;

        $stateData['localData'] = [];
        foreach($stateData['states']->local as $l) {
            $stateData['localData'][$l->lang_code] = $l->name; 
        }
        //dd($stateData);
        return view('state/edit',$stateData);

    }

    /****************************************************/
    # Function name : update
    # param : state_id, data, dataLocale
    # Purpose : update state data
    # Author : 
    # Created Date : 21/01/2019
    # Modified Date : 21/01/2019
    /****************************************************/
    public function update(Request $request ,$id)
    {
        
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

        $state = State::find($id);
        $state->name = $request->name['EN'];
        $state->country_id = $request->country;
        $state->status = '1';
        $state->save();
        TranslateState::where('state_id',$id)->delete();
        foreach ($this->lang_locales as $locale) {
            $state_local = new TranslateState;
            $state_local->state_id = $state->id;
            $state_local->lang_code = $locale->code;
            $state_local->name = $request->name[$locale->code];
            $state_local->save();

        }

        return \Redirect::back()->with('success', 'State is updated successfully');

    }


    /****************************************************/
    # Function name : delete
    # param : id
    # Purpose : soft delete state
    # Author : 
    # Created Date : 21/01/2019
    # Modified Date : 21/01/2019
    /****************************************************/
    public function delete($id)
    {
        
        try {
        State::where('id', $id)->delete();
        //StateLocale::where('state_id', $id)->delete();
        session()->flash('message', 'State deleted successfully');
        Session::flash('alert-class', 'alert-success'); 
        
        
        return redirect('state/list');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('message', 'Some error occured during delete state');
            Session::flash('alert-class', 'alert-danger');
          return redirect('state/list');
        }
        
    }
    /****************************************************/
    # Function name : changeStatus
    # param : state
    # Purpose : state active/inactive
    # Author : 
    # Created Date : 21/01/2019
    # Modified Date : 21/01/2019
    /****************************************************/

    public function status(Request $request, $id){
        
        try {
            $state = State::find($id);
            
            if($state->status == 1)
            {
                $status = 0;
            } 
            else 
            {
                $status = 1;
            }
            $state->status = $status;
            $state->save();
            
        
            return \Redirect::back()->with('success', 'State  status is  changed successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
          return \Redirect::back()->with('success', 'Some error occured during state status update');
        }
    }

}
