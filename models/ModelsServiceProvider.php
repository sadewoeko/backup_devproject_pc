<?php namespace Models;
 
/**
* ServiceProvider
*
* The service provider for the modules. After being registered
* it will make sure that each of the modules are properly loaded
* i.e. with their routes, views etc.
*
* @author Kamran Ahmed <kamranahmed.se@gmail.com>
* @package App\Modules
*/
class ModelsServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register() {}

}