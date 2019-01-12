<?php

namespace App\Modules\Api\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Lib\core\path_config as config;
use DB;
use App\State;
use App\City;
use App\Country;

class ApiPahala extends Controller 
{
    public $controller_name = 'Api';
    

    public function sellFetch($flag) 
    {
        $conn = DB::connection('mysql');
        
        if ($flag != 'all') {
            $flag = $flag == 'sell' ? 0 : 1;
            $sql = "SELECT * FROM catalogues JOIN catalogue_images ON catalogues.id = catalogue_images.catalogue_id JOIN catagories
                ON catalogues.product_category = catagories.id WHERE flag = " . $flag . "";
        } else {
            $sql = "SELECT * FROM catalogues JOIN catalogue_images ON catalogues.id = catalogue_images.catalogue_id JOIN catagories
                ON catalogues.product_category = catagories.id";
        }
        
        $result = $conn->select($sql);
        return $result;     
    }

    public function search($flag, $query) 
    {
        $conn = DB::connection('mysql');
        
        if ($flag != 'all') {
            $flag = $flag == 'sell' ? 0 : 1;
            $sql = "SELECT * FROM catalogues JOIN catalogue_images ON catalogues.id = catalogue_images.catalogue_id JOIN catagories
                ON catalogues.product_category = catagories.id WHERE flag = " . $flag . " and product_name like '%" . $query . "%'";
        } else {
            $sql = "SELECT * FROM catalogues JOIN catalogue_images ON catalogues.id = catalogue_images.catalogue_id JOIN catagories
                ON catalogues.product_category = catagories.id WHERE product_name like '%" . $query . "%'";
        }
        
        $result = $conn->select($sql);
        return $result;     
    }

    public function getCountries($keyword)
    {
        $countries = Country::where('name', 'like', '%' . $keyword . '%')->get();
        return $countries;
    
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return $states;
    }

    public function getPhoneCode($country_id)
    {
        $phonecode = Country::findOrFail($country_id);
        return $phonecode['phonecode'];
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return $cities;
    }

    public function checkNewMessages($user_id)
    {
        $conn = DB::connection('mysql');

        $sql = "SELECT count(id) as new_messages FROM messages
                WHERE receiver_id = " . $user_id . " and baca = 0;";
        
        $result = $conn->select($sql);
        return $result;     
    }

    public function getCategories($limit)
    {
        $conn = DB::connection('mysql');

        $sql = "SELECT * FROM catagories ORDER BY category asc
                limit " . $limit . "";
        
        $result = $conn->select($sql);
        return $result;     
    }
}
