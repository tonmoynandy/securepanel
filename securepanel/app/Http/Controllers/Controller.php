<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $lang_locales = array();
    
    public function __construct(){
        $languagesList = \Cache::remember('language-list', 60, function () {
		        return \App\Language::orderby('id')->get();
			});
       
        $this->lang_locales = $languagesList;
        
        \View::share(['lang_locales' => $this->lang_locales]);
        
    }

    public function response($code, $data, $success=true) {
        $result = [];
        $result['code'] = $code;
        if ($data ) {
            if ((is_object($data) || is_array($data))) {
                $result['body'] = \base64_encode(\json_encode($data));
            } else if (is_string($data)) {
                $result['body'] = \base64_encode($data);
            }
        }
        if ($success) {
            $result['status'] = 'success';
        } else {
            $result['status'] = 'error';
        }
        return $result;
        
    }
}
