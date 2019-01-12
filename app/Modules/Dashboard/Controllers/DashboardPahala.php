<?php

namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Lib\core\path_config as config;
use DB;
use App\Category;

class DashboardPahala extends Controller 
{
    public $controller_name = 'Dashboard';
    

    public function sellDashboard() 
    {
        if(empty(session('full_name'))) {
            return redirect()->route('auth.sign-in')->with('authlog', 'Sorry You have to login to access this page!');
        } else {
            

            $content['title'] = "Selling Tools Dashboard";
            // $conn = DB::connection('mysql');
            // $sql = "SELECT * FROM catalogues JOIN catalogue_images ON catalogues.id = catalogue_images.catalogue_id JOIN catagories
            //         ON catalogues.product_category = catagories.id WHERE user_id = ".session('id')." AND flag = 0";
            // $execute = $conn->select($sql);
            // $result = $execute;
            // $content['datas'] = $result;
            // return view($this->controller_name .'::sell-dash',$content);
            $sess_id = session('id');
            /*$content['gender'] = DB::table('users')
                                ->where('user_id','=',$sess_id)
                                ->select('gender');*/

            $content['datas'] = DB::table('catalogues')
                            ->where('user_id','=',$sess_id)
                            ->where('flag', '=', 0)
                            ->join('users','users.id','=','catalogues.user_id')
                            ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                            ->join('catagories','catalogues.product_category','=','catagories.id')
                            ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.payment','catalogues.packaging','catalogues.delivery','catalogues.product_stock','catagories.category','catalogue_images.image','users.gender')
                            ->groupBy('catalogues.id')
                            ->orderBy('catalogues.id','DESC')->paginate(10);

            return view($this->controller_name .'::sell-dash',$content);
        }
        
    }

    public function create() 
    {
        $currency['currency'] = \Models\currency::select('code','symbol')->get();
        //var_dump($currency);die();
        return view($this->controller_name . '::create',$currency);
    }

    public function storeSelling(Request $request) 
    {
        $test = input::all();
        if(empty($request->file('upload_image')))
        {
            // return redirect()->route('dashboard.create')->with('failed', 'Image failed insert, Please Check!!');
            return Redirect::back()
                           ->with('failed', 'Image failed insert, Please Check!!')
                           ->withInput($test);
        }
        $test = input::all();
        if(empty($request->input('currency')))
        {
            // return redirect()->route('dashboard.create')->with('failed', 'Currency failed choose, Please Check!!');
            return Redirect::back()
                            ->with('failed', 'Currency failed choose, Please Check!!')
                            ->withInput($test);
        }
        $test = input::all();
        if(empty($request->input('product_price')))
        {
            // return redirect()->route('dashboard.create')->with('failed', 'Product Price failed insert, Please Check!!');
            return Redirect::back()
                            ->with('failed', 'Product Price failed insert, Please Check!!')
                            ->withInput($test);
        }
        $validation = Validator::make($request->all(),[
            'product_name'  => 'required',
            'category'      => 'required',
            'product_price' => 'required',
            'product_stock' => 'required',
            'product_desc'  => 'required',
            'payment'       => 'required',
            'packaging'     => 'required',
            'delivery'      => 'required'
        ]);
        
        $test = input::all();
        if ($validation->fails()) 
        {
            return Redirect::route(strtolower($this->controller_name) . '.create')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.')
                        ->withInput($test);
        } 
        else 
        {
            $file = $request->file('upload_image');

            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpeg' || $file->getClientOriginalExtension() == 'JPG')
            {
                $data = array(
                    'product_name'      => $request->input('product_name'),
                    'product_desc'      => $request->input('product_desc'),
                    'currency'          => $request->input('currency'),
                    'product_price'     => $request->input('product_price'),
                    'payment'           => $request->input('payment'),
                    'packaging'         => $request->input('packaging'),
                    'delivery'          => $request->input('delivery'),
                    'product_stock'     => $request->input('product_stock'),
                    'user_id'           => session('id'),
                    'flag'              => 0,
                    'status'            => 1,
                    'iklan'             => 0,
                    'product_category'  => $request->input('category')
                );

                $result = \Models\catalogues::create($data);
                if ($result)
                {
                    $cat_id         = $result->id;
                    $access_time    = date('Ymdhis');
                    $sess_name      = session('id');
                    $file_name      = $file->getClientOriginalName();
                    $new_file_name  = $access_time.'_'.$sess_name.'_'.$file_name;      
                    
                    #$upload = Storage::disk('public_upload')->put(config::$folder_image, $request->file('upload_image'));
                    $file->move(base_path('public/uploads/product'), $new_file_name);
                    $img_dat = array(
                        'catalogue_id'  => $cat_id,
                        'image'         => $new_file_name
                    );

                    $store_img = \Models\catalogue_images::create($img_dat);
                    if ($store_img)
                    {
                        return redirect()->route('dashboard.create')->with('success', 'OK ,Data Success Inserted !!');
                    }
                    else
                    {
                        // return redirect()->route('dashboard.create')->with('wrong', 'Hmm, Something Wrong!!');
                        return Redirect::back()
                                        ->with('wrong', 'Hmm, Something Wrong!!')
                                        ->withInput($test);
                    }
                }
                else
                {
                    // return redirect()->route('dashboard.create')->with('failed', 'Data failed insert, Please Check!!');
                    return Redirect::back()
                                    ->with('failed', 'Data failed insert, Please Check!!')
                                    ->withInput($test); 
                }

                
            }
            else
            {
                // return redirect()->route('dashboard.create')->with('error-img', 'So Sorry Your Image Not Match With Our Rules !');
                return Redirect::back()
                                ->with('error-img', 'So Sorry Your Image Not Match With Our Rules !')
                                ->withInput($test);
            }
        }
    }

    public function sellingList() {

    }

    public function buyDashboard() {
        if(empty(session('full_name'))) {
            return redirect()->route('auth.sign-in')->with('authlog', 'Sorry You have to login to access this page!');
        } else {
            $content['title'] = "Buying Tools Dashboard";
            // $conn = DB::connection('mysql');
            // $sql = "SELECT * FROM catalogues c JOIN catalogue_images ci ON c.id = ci.catalogue_id JOIN catagories ct
            //         ON c.product_category = ct.id WHERE user_id = ".session('id')." AND flag = 1";
            // $execute = $conn->select($sql);
            // $result = $execute;
            // $content['datas'] = $result;
            $sess_id = session('id');
            $content['datas'] = DB::table('catalogues')
                            ->where('user_id','=',$sess_id)
                            ->where('flag', '=', 1)
                            ->join('users','users.id','=','catalogues.user_id')
                            ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                            ->join('catagories','catalogues.product_category','=','catagories.id')
                            ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.destination','catalogues.product_origin','catalogues.pay_terms','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image','users.gender')
                            ->groupBy('catalogues.id')
                            ->orderBy('catalogues.id','DESC')->paginate(10);

            return view($this->controller_name .'::buy-dash',$content);
        }
    }

    public function create_buying() 
    {
        $currency['currency'] = \Models\currency::select('code','symbol')->get();
        return view($this->controller_name . '::create_buying',$currency);
    }

    public function storeBuying(Request $request) 
    {
        $test = input::all();
        if(empty($request->file('upload_image')))
        {
            // return redirect()->route('dashboard.create_buying')->with('failed', 'Image failed insert, Please Check!!');
            return Redirect::back()
                            ->with('failed', 'Image failed insert, Please Check!!')
                            ->withInput($test);
        }
        $test = input::all();
        if(empty($request->input('destination')))
        {
            // return redirect()->route('dashboard.create')->with('failed', 'Product Price failed insert, Please Check!!');
            return Redirect::back()
                            ->with('failed', 'Destination failed insert, Please Check!!')
                            ->withInput($test);
        }
        
        $validation = Validator::make($request->all(),[
            'product_name'  => 'required',
            'category'      => 'required',
            'destination'   => 'required',
            'product_origin'   => 'required',
            'pay_terms'     => 'required',
            'product_stock' => 'required',
            'product_desc'  => 'required'
        ]);

        $test = input::all();
        if ($validation->fails()) 
        {
            return Redirect::route(strtolower($this->controller_name) . '.create_buying')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.')
                        ->withInput($test);
        } 
        else 
        {
            $file = $request->file('upload_image');

            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpeg')
            {
                $data = array(
                    'product_name'      => $request->input('product_name'),
                    'product_desc'      => $request->input('product_desc'),
                    'destination'       => $request->input('destination'),
                    'product_origin'    => $request->input('product_origin'),
                    'pay_terms'         => $request->input('pay_terms'),
                    'product_stock'     => $request->input('product_stock'),
                    'user_id'           => session('id'),
                    'flag'              => 1,
                    'status'            => 1,
                    'iklan'             => 0,
                    'product_category'  => $request->input('category')
                );

                $result = \Models\catalogues::create($data);
                if ($result)
                {
                    $cat_id         = $result->id;
                    $access_time    = date('Ymdhis');
                    $sess_name      = session('id');
                    $file_name      = $file->getClientOriginalName();
                    $new_file_name  = $access_time.'_'.$sess_name.'_'.$file_name;      
                    
                    #$upload = Storage::disk('public_upload')->put(config::$folder_image, $request->file('upload_image'));
                    $file->move(base_path('public/uploads/product'), $new_file_name);
                    $img_dat = array(
                        'catalogue_id'  => $cat_id,
                        'image'         => $new_file_name
                    );

                    $store_img = \Models\catalogue_images::create($img_dat);
                    if ($store_img)
                    {
                        return redirect()->route('dashboard.create_buying')->with('success', 'OK ,Data Success Inserted !!');
                    }
                    else
                    {
                        // return redirect()->route('dashboard.create_buying')->with('wrong', 'Hmm, Something Wrong!!');
                        return Redirect::back()
                                        ->with('wrong', 'Hmm, Something Wrong!!')
                                        ->withInput($test);
                    }
                }
                else
                {
                    // return redirect()->route('dashboard.create_buying')->with('failed', 'Data failed insert, Please Check!!');
                    return Redirect::back()
                                    ->with('failed', 'Data failed insert, Please Check!!')
                                    ->withInput($test); 
                }

                
            }
            else
            {
                // return redirect()->route('dashboard.create_buying')->with('error-img', 'So Sorry Your Image Not Match With Our Rules !');
                return Redirect::back()
                                ->with('error-img', 'So Sorry Your Image Not Match With Our Rules !')
                                ->withInput($test);
            }
        }
    }

    public function destroy($id)
    {
        $conn = DB::connection('mysql');
        $sql = "DELETE FROM catalogues WHERE id = ".$id. "";
        $execute = $conn->delete($sql);
        return redirect()->route('dashboard.sell-dash');
    }

    public function delete($id)
    {
        $conn = DB::connection('mysql');
        $sql = "DELETE FROM catalogues WHERE id = ".$id. "";
        $execute = $conn->delete($sql);
        return redirect()->route('dashboard.buy-dash');
    }

    public function productDetail($id) 
    {
        
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.currency,a.product_price,a.payment,a.packaging,a.delivery,a.product_stock,u.image as images ,u.full_name,u.email,company.company_name,u.country_id,u.state_id,u.city_id,u.cellphone,u.cellphone2,u.address,u.website,c.category,b.image, co.name as negara, s.name as negaraa, city.name as kota, company.address_company, company.office_phone, company.office_phone2, company.desc_company
                FROM catalogues a 
                JOIN catalogue_images b ON a.id = b.catalogue_id
                JOIN users u 
                JOIN catagories c ON a.product_category = c.id 
                JOIN countries co ON co.id = u.country_id
                JOIN states s ON s.id = u.state_id
                JOIN cities city ON city.id = u.city_id
                JOIN company ON company.user_id = u.id
                WHERE a.id = ".$id." AND a.user_id = u.id";
        $execute = $conn->select($sql);
        $result = $execute;
        $content['data'] = $result[0];

        return view('productDetail', $content);
    }

    public function productDetailBuy($id) 
    {
        
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.destination,a.product_origin,a.pay_terms,a.product_stock,u.image as images ,u.full_name,u.email,company.company_name,u.country_id,u.state_id,u.city_id,u.cellphone,u.cellphone2,u.address,u.website,c.category,b.image, co.name as negara, s.name as negaraa, city.name as kota, company.address_company, company.office_phone, company.office_phone2, company.desc_company
                FROM catalogues a 
                JOIN catalogue_images b ON a.id = b.catalogue_id
                JOIN users u 
                JOIN catagories c ON a.product_category = c.id 
                JOIN countries co ON co.id = u.country_id
                JOIN states s ON s.id = u.state_id
                JOIN cities city ON city.id = u.city_id
                JOIN company ON company.user_id = u.id
                WHERE a.id = ".$id." AND a.user_id = u.id";
        $execute = $conn->select($sql);
        $result = $execute;
        $content['data'] = $result[0];

        return view('productDetailBuy', $content);
    }
    
    public function update_buy(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'product_name'  => 'required',
            'product_category'      => 'required',
            'destination'   => 'required',
            'product_origin' => 'required',
            'pay_terms'     => 'required',
            'product_stock' => 'required',
            'product_desc'  => 'required'
        ]);

        if ($validation->fails()) 
        {
            return redirect()->route('dashboard.edit', $request->input('id'))->with('failed', 'Data failed insert'); 
        } 

        

        if ($request->file('image') != null) {

            $validator_img = Validator::make($request->all(), [
                'image' => 'max:2048',
            ]);

            if ($validator_img->fails()) 
            {
                return redirect()->route('dashboard.edit_buy', $request->input('id'))->with('failed', 'Maximum image size is 2048'); 
            } 

            $file = $request->file('image');
            
            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpeg' || $file->getClientOriginalExtension() == 'JPG') {

                    $access_time    = date('Ymdhis');
                    $sess_name      = session('id');
                    $file_name      = $file->getClientOriginalName();
                    $new_file_name  = $access_time.'_'.$sess_name.'_'.$file_name;      
                    $file->move(base_path('public/uploads/product'), $new_file_name);

                    DB::table('catalogue_images')
                    ->where('catalogue_id', '=' , $request->input('id'))
                    ->update(
                        [
                            'image' => $new_file_name
                        ]
                    );

                    DB::table('catalogues')
                    ->where('id', '=' , $request->input('id'))
                    ->update(
                        [
                            'product_name' => $request->input('product_name'),
                            'product_category' => $request->input('product_category'),
                            'destination'   => $request->input('destination'),
                            'product_origin'=> $request->input('product_origin'),
                            'pay_terms'     => $request->input('pay_terms'),
                            'product_stock' => $request->input('product_stock'),
                            'product_desc' => $request->input('product_desc')
                        ]
                    );

            } else {
                return redirect()->route('dashboard.edit_buy', $request->input('id'))->with('failed', 'Data failed insert, Please Check!!'); 
            }

        } else {
            DB::table('catalogues')
            ->where('id', '=' , $request->input('id'))
            ->update(
                [
                    'product_name' => $request->input('product_name'),
                    'product_category' => $request->input('product_category'),
                    'destination'   => $request->input('destination'),
                    'product_origin'=> $request->input('product_origin'),
                    'pay_terms'     => $request->input('pay_terms'),
                    'product_stock' => $request->input('product_stock'),
                    'product_desc' => $request->input('product_desc')
                ]
            );
        }

        return redirect()->route('dashboard.buy-dash');
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'product_name'  => 'required',
            'product_category'      => 'required',
            'product_price' => 'required',
            'payment'       => 'required',
            'packaging'     => 'required',
            'delivery'      => 'required',
            'product_stock' => 'required',
            'product_desc'  => 'required'
        ]);

        if ($validation->fails()) 
        {
            return redirect()->route('dashboard.edit', $request->input('id'))->with('failed', 'Data failed insert'); 
        } 

        

        if ($request->file('image') != null) {

            $validator_img = Validator::make($request->all(), [
                'image' => 'max:2048',
            ]);

            if ($validator_img->fails()) 
            {
                return redirect()->route('dashboard.edit', $request->input('id'))->with('failed', 'Maximum image size is 2048'); 
            } 

            $file = $request->file('image');
            
            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpeg' || $file->getClientOriginalExtension() == 'JPG' ) {

                    $access_time    = date('Ymdhis');
                    $sess_name      = session('id');
                    $file_name      = $file->getClientOriginalName();
                    $new_file_name  = $access_time.'_'.$sess_name.'_'.$file_name;      
                    $file->move(base_path('public/uploads/product'), $new_file_name);

                    DB::table('catalogue_images')
                    ->where('catalogue_id', '=' , $request->input('id'))
                    ->update(
                        [
                            'image' => $new_file_name
                        ]
                    );

                    DB::table('catalogues')
                    ->where('id', '=' , $request->input('id'))
                    ->update(
                        [
                            'product_name' => $request->input('product_name'),
                            'product_category' => $request->input('product_category'),
                            'currency' => $request->input('currency'),
                            'product_price' => $request->input('product_price'),
                            'payment'       => $request->input('payment'),
                            'packaging'     => $request->input('packaging'),
                            'delivery'      => $request->input('delivery'),
                            'product_stock' => $request->input('product_stock'),
                            'product_desc' => $request->input('product_desc')
                        ]
                    );

            } else {
                return redirect()->route('dashboard.edit', $request->input('id'))->with('failed', 'Image failed insert, Please Check Format Images!!'); 
            }

        } else {
            DB::table('catalogues')
            ->where('id', '=' , $request->input('id'))
            ->update(
                [
                    'product_name' => $request->input('product_name'),
                    'product_category' => $request->input('product_category'),
                    'currency' => $request->input('currency'),
                    'product_price' => $request->input('product_price'),
                    'payment'       => $request->input('payment'),
                    'packaging'     => $request->input('packaging'),
                    'delivery'      => $request->input('delivery'),
                    'product_stock' => $request->input('product_stock'),
                    'product_desc' => $request->input('product_desc')
                ]
            );
        }

        return redirect()->route('dashboard.sell-dash');
    }

    public function edit_buy($id)
    {
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.destination,a.product_origin,a.pay_terms,a.product_stock, a.product_category, a.id, c.category,b.image
                FROM catalogues a JOIN catalogue_images b ON a.id = b.catalogue_id JOIN catagories c
                ON a.product_category = c.id WHERE a.id = ".$id."";
        $execute = $conn->select($sql);
        $result = $execute;
        $content = $result[0];
        $categories = Category::get();
        
        return view($this->controller_name . '::edit-product-buy',compact('content', 'categories'));
    }

    public function edit($id)
    {
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.product_price,a.payment,a.packaging,a.delivery,a.product_stock, a.product_category, a.currency, a.id, c.category,b.image
                FROM catalogues a JOIN catalogue_images b ON a.id = b.catalogue_id JOIN catagories c
                ON a.product_category = c.id WHERE a.id = ".$id."";
        $currency = \Models\currency::select('code','symbol')->get();
        $execute = $conn->select($sql);
        $result = $execute;
        $content = $result[0];
        $categories = Category::get();
        
        return view($this->controller_name . '::edit-product',compact('content', 'currency', 'categories'));
    }
}
