<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Route::group(['prefix' => 'auth', 'namespace' => 'App\Modules\Auth\Controllers', 'middleware' => ['web']], function(){
    route::get('/', ['as' => 'auth.index', 'uses' => 'AuthPahala@index']);
    route::get('/logout', ['as' => 'auth.logout', 'uses' => 'AuthPahala@logout']);
    route::get('/sign-in', ['as' => 'auth.sign-in', 'uses' => 'AuthPahala@signIn']);
    route::get('/forgot/password', ['as' => 'auth.forgot-password', 'uses' => 'AuthPahala@forgotPassword']);
    route::get('/reset/password/{token}', ['as' => 'auth.reset-password', 'uses' => 'AuthPahala@resetPassword']);
    route::post('/register', ['as' => 'auth.register', 'uses' => 'AuthPahala@register']);
    route::post('/login', ['as' => 'auth.login', 'uses' => 'AuthPahala@login']);
    route::post('/submit/reset/password', ['as' => 'auth.submit-reset-password', 'uses' => 'AuthPahala@submitResetPassword']);
    route::post('/forgot/password/generate', ['as' => 'auth.generate-token-forgot-password', 'uses' => 'AuthPahala@generateForgotPassword']);
});

