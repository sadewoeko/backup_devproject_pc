<?php

namespace App\Modules\Profile\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Lib\core\path_config as config;
use DB;
use App\User;
use App\Company;
use App\Country;
use App\City;
use App\State;

class ProfileController extends Controller 
{
    public $controller_name = 'Profile';
    
    public function index($user_id) 
    { 
        $conn = DB::connection('mysql');
        $count = DB::table('company')
                ->where('user_id', '=', $user_id)
                ->count();
        if ($count==0){
            DB::table('company')
                ->insert(
                    [
                        'user_id' => $user_id
                    ]
                );
        }

        $sql = "SELECT u.*,co.company_name,co.address_company,co.office_phone,co.office_phone2,co.desc_company, c.name as country, s.name as state, city.name as city  FROM users u
                LEFT JOIN countries c ON c.id = u.country_id
                LEFT JOIN states s ON s.id = u.state_id
                LEFT JOIN cities city ON city.id = u.city_id
                JOIN company co ON u.id = co.user_id
                WHERE u.id = " . $user_id . ";";
        
        $result = $conn->select($sql);

        $products = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image')
                    ->where('catalogues.user_id', '=', $user_id)
                    ->get();

        $conn = DB::connection('mysql');
        $sql = "SELECT 
                    u.id,u.email,u.image,u.full_name,u.gender,u.address,u.cellphone,u.cellphone2,u.country_id,u.state_id,u.city_id,u.website,
                    co.company_name,co.address_company,co.office_phone,co.office_phone2,co.desc_company,
                    c.name as country,
                    s.name as state,
                    ct.name as city, 
                    ct.id as city_id
                FROM users u 
                LEFT JOIN countries c ON u.country_id = c.id 
                LEFT JOIN states s ON u.state_id = s.id 
                LEFT JOIN cities ct ON u.city_id = ct.id
                JOIN company co ON co.user_id = u.id
                WHERE u.id = ".$user_id." GROUP BY u.id";
        $result = $conn->select($sql);
        $countries = Country::get();
        $cities = City::where('state_id', '=', $result[0]->state_id)->get();
        $states = State::where('country_id', '=', $result[0]->country_id)->get();
        
        return view($this->controller_name .'::index', compact('result', 'products','countries','cities','states'));    
    }

    // public function edit($user_id)
    // {

    //     $conn = DB::connection('mysql');
    //     $sql = "SELECT 
    //                 u.*,
    //                 c.name as country,
    //                 s.name as state,
    //                 ct.name as city, 
    //                 ct.id as city_id
    //             FROM users u 
    //             LEFT JOIN countries c ON u.country_id = c.id 
    //             LEFT JOIN states s ON u.state_id = s.id 
    //             LEFT JOIN cities ct ON u.city_id = ct.id 
    //             WHERE u.id = ".$user_id."";
    //     $result = $conn->select($sql);
    //     $countries = Country::get();
    //     $cities = City::get();
    //     $states = State::get();

        
    //     return view($this->controller_name .'::edit',compact('result','countries', 'cities', 'states'));
    // }

    public function show($user_id)
    {
        
        return view($this->controller_name .'::show');
    }

    public function product($user_id)
    {
        $conn = DB::connection('mysql');

        $sql = "SELECT u.*, c.name as country, s.name as state, city.name as city  FROM users u
                LEFT JOIN countries c ON c.id = u.country_id
                LEFT JOIN states s ON s.id = u.state_id
                LEFT JOIN cities city ON city.id = u.city_id
                WHERE u.id = " . $user_id . ";";
        
        $result = $conn->select($sql);

        $products = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image')
                    ->where('catalogues.user_id', '=', $user_id)
                    ->get();

        return view($this->controller_name .'::show', compact('result', 'products'));
    }

    public function update(Request $request)
    {
        
        $validation = Validator::make($request->all(),[
            'full_name'    => 'required',
            'country_id'   => 'required',
            'state_id'     => 'required',
            'city_id'      => 'required',
            'cellphone'    => 'required',
            'cellphone2'   => 'required',
            'address'      => 'required'
            
        ]);

        if ($validation->fails()) 
        {
            return redirect()->route('profile.index', $request->input('id'))->with('failed', 'Data failed insert'); 
        } 

        

        if ($request->file('image') != null) {

            $validator_img = Validator::make($request->all(), [
                'image' => 'max:2048',
            ]);

            if ($validator_img->fails()) 
            {
                return redirect()->route('profile.index', $request->input('id'))->with('failed', 'Maximum image size is 2048'); 
            } 

            $file = $request->file('image');
            
            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpeg') {

                    $access_time    = date('Ymdhis');
                    $sess_name      = session('id');
                    $file_name      = $file->getClientOriginalName();
                    $new_file_name  = $access_time.'_'.$sess_name.'_'.$file_name;      
                    $file->move(base_path('public/uploads/photo'), $new_file_name);

                    

                    DB::table('users')
                    ->where('id', '=' , $request->input('id'))
                    ->update(
                        [
                            'image' => $new_file_name,
                            'full_name' => $request->input('full_name'),
                            'country_id' => $request->input('country_id'),
                            'state_id' => $request->input('state_id'),
                            'city_id' => $request->input('city_id'),
                            'cellphone' => $request->input('cellphone'),
                            'cellphone2' => $request->input('cellphone2'),
                            'address' => $request->input('address'),
                            'website' => $request->input('website')
                        ]
                    );
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                    DB::table('company')
                    ->where('id', '=' , $request->input('id'))
                    ->update(
                        [
                            'user_id' => $request->input('id'),
                            'company_name' => $request->input('company_name'),
                            'address_company' => $request->input('address_company'),
                            'office_phone' => $request->input('office_phone'),
                            'office_phone2' => $request->input('office_phone2'),
                            'desc_company' => $request->input('desc_company')
                        ]
                    );

            } else {
                return redirect()->route('profile.index', $request->input('id'))->with('failed', 'Data failed insert, Please Check!!'); 
            }

        } else {
            DB::table('users')
            ->where('id', '=' , $request->input('id'))
            ->update(
                [
                    'full_name' => $request->input('full_name'),
                    'country_id' => $request->input('country_id'),
                    'state_id' => $request->input('state_id'),
                    'city_id' => $request->input('city_id'),
                    'cellphone' => $request->input('cellphone'),
                    'cellphone2' => $request->input('cellphone2'),
                    'address' => $request->input('address'),
                    'website' => $request->input('website')
                ]
            );

            DB::table('company')
                    ->where('user_id', '=' , $request->input('id'))
                    ->update(
                        [
                            'company_name' => $request->input('company_name'),
                            'address_company' => $request->input('address_company'),
                            'office_phone' => $request->input('office_phone'),
                            'office_phone2' => $request->input('office_phone2'),
                            'desc_company' => $request->input('desc_company')
                        ]
                    );
        }

        return redirect()->route('profile.index', $request->input('id'));
    }
}