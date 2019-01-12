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

route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
route::get('/filter/{flag?}/{country?}', ['as' => 'index.filter', 'uses' => 'HomeController@filter']);
route::get('/productDetail/{id}', ['as' => 'productDetail.detail', 'uses' => 'HomeController@productDetail']);
route::get('/productDetailBuy/{id}', ['as' => 'productDetailBuy.detail', 'uses' => 'HomeController@productDetailBuy']);
route::get('/search', ['as' => 'search', 'uses' => 'HomeController@search']);
route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);
route::get('/privacy', ['as' => 'privacy', 'uses' => 'HomeController@privacy']);
route::get('/help', ['as' => 'help', 'uses' => 'HomeController@help']);
route::get('/member', ['as' => 'member', 'uses' => 'HomeController@member']);
route::get('/products', ['as' => 'products', 'uses' => 'HomeController@products']);
route::get('/product_all/{flag}', ['as' => 'product_all', 'uses' => 'HomeController@product_all']);
//route::get('/product_all/{flag}', ['as' => 'product_all', 'uses' => 'HomeController@product_all']);
route::get('/categoryProduct/{flag}', ['as' => 'categoryProduct.detail', 'uses' => 'HomeController@byCategory']);
route::get('/show_category', ['as' => 'show_category', 'uses' => 'HomeController@show_category']);
route::get('/advertisement', ['as' => 'advertisement', 'uses' => 'HomeController@advertisement']);

