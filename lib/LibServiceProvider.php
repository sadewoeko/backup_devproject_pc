<?php namespace Lib;
 
/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*/
class LibServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register() {}

}