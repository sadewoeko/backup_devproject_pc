<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Admin extends Controller {
    
   
    public $controller_name = 'Admin';
  

    public function index(){
        $content['title'] = 'Testing HMVC';
        return view($this->controller_name .'::index_admin', $content);
    }
}
