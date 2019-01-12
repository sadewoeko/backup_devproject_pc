<?php

Route::group(['prefix' => 'messages', 'namespace' => 'App\Modules\Messaging\Controllers', 'middleware' => ['web']], function(){
    
    route::get('/', ['as' => 'messaging.index', 'uses' => 'MessagingController@index']);
    route::get('/{sender_id}/{receiver_id}/{product_id?}', ['as' => 'messaging.detail', 'uses' => 'MessagingController@detail']);
    route::post('/send', ['as' => 'messaging.send', 'uses' => 'MessagingController@send']);
    route::get('/{catalogue_id}', ['as' => 'messaging.delete_message', 'uses' => 'MessagingController@delete_message']);
    // route::post('/{sender_id}', ['as' => 'messaging.show', 'uses' => 'MessagingController@show']);
    // route::post('/outbox', ['as' => 'messaging.outbox', 'uses' => 'MessagingController@outbox']);
});