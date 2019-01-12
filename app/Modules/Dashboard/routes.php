<?php

Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Modules\Dashboard\Controllers', 'middleware' => ['web']], function(){ 
    route::get('/sell-dash', ['as' => 'dashboard.sell-dash', 'uses' => 'DashboardPahala@sellDashboard']);
    route::get('/buy-dash', ['as' => 'dashboard.buy-dash', 'uses' => 'DashboardPahala@buyDashboard']);
    route::get('/create', ['as' => 'dashboard.create', 'uses' => 'DashboardPahala@create']);
    route::post('/storeSelling', ['as' => 'dashboard.storeSelling', 'uses' => 'DashboardPahala@storeSelling']);
    route::post('/storeBuying', ['as' => 'dashboard.storeBuying', 'uses' => 'DashboardPahala@storeBuying']);
    route::get('/create_buying', ['as' => 'dashboard.create_buying', 'uses' => 'DashboardPahala@create_buying']);
    route::get('destroy/{id}', ['as' => 'dashboard.destroy','uses' => 'DashboardPahala@destroy']);
    route::get('delete/{id}', ['as' => 'dashboard.delete','uses' => 'DashboardPahala@delete']);
    route::get('/productDetail/{id}', ['as' => 'dashboard.productDetail', 'uses' => 'DashboardPahala@productDetail']);
    route::get('/productDetailBuy/{id}', ['as' => 'dashboard.productDetailBuy', 'uses' => 'DashboardPahala@productDetailBuy']);
    route::get('/edit_buy/{id}', ['as' => 'dashboard.edit_buy', 'uses' => 'DashboardPahala@edit_buy']);
    route::get('/edit/{id}', ['as' => 'dashboard.edit', 'uses' => 'DashboardPahala@edit']);
    route::post('/update_buy', ['as' => 'dashboard.update_buy', 'uses' => 'DashboardPahala@update_buy']);
    route::post('/update', ['as' => 'dashboard.update', 'uses' => 'DashboardPahala@update']);
});