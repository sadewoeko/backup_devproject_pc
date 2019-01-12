<?php

Route::group(['prefix' => 'iklan', 'namespace' => 'App\Modules\iklan\Controllers', 'middleware' => ['web']], function(){ 
    route::get('/create_iklan', ['as' => 'iklan.create_iklan', 'uses' => 'IklanController@create_iklan']);
    route::get('/iklan_dash', ['as' => 'iklan.iklan_dash', 'uses' => 'IklanController@iklanDashboard']);
    route::post('/storeIklan', ['as' => 'iklan.storeIklan', 'uses' => 'IklanController@storeIklan']);
    
});