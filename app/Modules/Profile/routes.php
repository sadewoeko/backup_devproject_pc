<?php

Route::group(['prefix' => 'profile', 'namespace' => 'App\Modules\Profile\Controllers', 'middleware' => ['web']], function(){
    route::get('/edit/{user_id}', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);        
    route::post('/update', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);        
    route::get('/{user_id}', ['as' => 'profile.index', 'uses' => 'ProfileController@index']);
    route::get('/{user_id}/product', ['as' => 'profile.product', 'uses' => 'ProfileController@product']);
});