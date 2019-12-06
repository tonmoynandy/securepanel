<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::post('/login-action', 'HomeController@loginAction')->name('login_action');
Route::get('/forget-password', 'HomeController@forgetPassword')->name('forget_password');
Route::post('/forget-password-action', 'HomeController@forgetPasswordAction')->name('forget_password_action');

Route::group(['as'=>'secure_','middleware'=>['auth']], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/logout', 'HomeController@logout')->name('logout');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/change-password-action', 'ProfileController@changePasswordAction')->name('change_password_action');

    //*********** Author Management ***************//
    Route::group(['prefix' => 'authors', 'as' => 'author_'], function() {
        Route::get('/', 'AuthorsController@index')->name('list');
        Route::get('/add', 'AuthorsController@add')->name('add');
        Route::post('/store', 'AuthorsController@store')->name('store');

        Route::get('/edit/{id}', 'AuthorsController@edit')->name('edit');
        Route::post('/update/{id}', 'AuthorsController@update')->name('update');

        Route::get('/status/{id}', 'AuthorsController@status')->name('change-status');
        Route::get('/delete/{id}', 'AuthorsController@delete')->name('delete');
    });
    
    
	//*********** CMS ***************//
	Route::group(['prefix'=>'cms','as'=>'cms_'], function(){
		Route::get('/list', 'CmsController@index')->name('list');
		Route::get('/edit/{id}', 'CmsController@edit')->name('edit');
		Route::post('/update/{id}', 'CmsController@update')->name('update');
        Route::get('/status/{id}', 'CmsController@status')->name('change_status');
        
    });
    
    //*********** COUNTRY ***************//
	Route::group(['as'=>'country_','prefix'=>'country'], function(){
		Route::get('/list', 'CountryController@index')->name('list');
        Route::get('/create', 'CountryController@add')->name('add');
        Route::post('/create-action', 'CountryController@save')->name('add_action');
        Route::get('/edit/{id}', 'CountryController@edit')->name('edit');
        Route::post('/update/{id}', 'CountryController@update')->name('edit_action');
        Route::get('/delete/{id}', 'CountryController@delete')->name('delete');
		Route::get('/status/{id}', 'CountryController@status')->name('change_status');
    });
    
    //*********** STATES ***************//
	Route::group(['as'=>'state_','prefix'=>'state'], function(){
        Route::get('/list', 'StateController@index')->name('list');
        Route::get('/create', 'StateController@add')->name('add');
        Route::post('/create-action', 'StateController@save')->name('add_action');
		Route::get('/edit/{id}', 'StateController@edit')->name('edit');
		Route::post('/update/{id}', 'StateController@update')->name('update');
        Route::get('/status/{id}', 'StateController@status')->name('change_status');
        Route::get('/delete/{id}', 'StateController@delete')->name('delete');
    });
    
    //*********** CITY ***************//
	Route::group(['as'=>'city_','prefix'=>'city'], function(){
        Route::get('/list', 'CityController@index')->name('list');
        Route::get('/create', 'CityController@add')->name('add');
        Route::post('/create-action', 'CityController@save')->name('add_action');
		Route::get('/edit/{id}', 'CityController@edit')->name('edit');
		Route::post('/update/{id}', 'CityController@update')->name('update');
        Route::get('/status/{id}', 'CityController@changestatus')->name('change_status');
        Route::get('/delete/{id}', 'CityController@delete')->name('delete');
        Route::post('/state-list', 'CityController@stateList')->name('state_list');
	});

    //************* Site Settings Management **************//
    Route::group(['prefix'=>'site-settings', 'as'=>'settings_'], function(){
        Route::get('/list', 'SettingController@index')->name('list');
        Route::post('/update/{id}', 'SettingController@update')->name('update');
    });

   
});


