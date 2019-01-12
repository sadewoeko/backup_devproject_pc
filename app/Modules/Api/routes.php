<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Route::group(['prefix' => 'api', 'namespace' => 'App\Modules\Api\Controllers', 'middleware' => ['web']], function(){
    route::get('/catalogues/fetch/{flag}', ['as' => 'api.sell.fetch', 'uses' => 'ApiPahala@sellFetch']);
    route::get('/catalogues/search/{flag}/{query}', ['as' => 'api.sell.fetch', 'uses' => 'ApiPahala@search']);
    
    route::get('/get/countries/{keyword}', ['as' => 'api.get.countries', 'uses' => 'ApiPahala@getCountries']);
    route::get('/get/state/{country_id}', ['as' => 'api.get.state', 'uses' => 'ApiPahala@getStates']);
    route::get('/get/phonecode/{country_id}', ['as' => 'api.get.phonecode', 'uses' => 'ApiPahala@getPhoneCode']);
    route::get('/get/cities/{state_id}', ['as' => 'api.get.cities', 'uses' => 'ApiPahala@getCities']);

    route::get('/get/categories/{limit}', ['as' => 'api.get.categories', 'uses' => 'ApiPahala@getCategories']);
    
    
    route::get('/check/new/messages/{user_id}', ['as' => 'api.check.new.messages', 'uses' => 'ApiPahala@checkNewMessages']);
    
    Route::get('/get/captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {
        return $captcha->src($config);
    });

    
});

