<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Route::group(['prefix' => 'admin','namespace' => 'App\Modules\Admin\Controllers','middleware' => ['web']], function(){
    route::get('/',['as' => 'admin.index','uses' => 'Admin@index']);
});

