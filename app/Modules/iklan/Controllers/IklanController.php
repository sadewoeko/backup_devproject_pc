<?php

namespace App\Modules\iklan\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Lib\core\path_config as config;
use DB;

class IklanController extends Controller 
{
    public $controller_name = 'iklan';

    public function iklanDashboard() {
        if(empty(session('full_name'))) {
        } else {
            $content['title'] = "Iklan Tools Dashboard";
            $conn = DB::connection('mysql');
            $sql = "SELECT * FROM catalogues c JOIN catalogue_images ci ON c.id = ci.catalogue_id JOIN catagories ct
                    ON c.product_category = ct.id WHERE user_id = ".session('id')." AND iklan = 1";
            $execute = $conn->select($sql);
            $result = $execute;
            $content['datas'] = $result;
            return view($this->controller_name .'::iklan_dash',$content);
        }
    }

    public function create_iklan() 
    {
        $currency['currency'] = \Models\currency::select('code','symbol')->get();
        return view($this->controller_name . '::create_iklan',$currency);
    }

    public function storeIklan(Request $request) {
        $validation = Validator::make($request->all(),[
            'product_name'  => 'required',
            'category'      => 'required',
            'product_price' => 'required',
            'product_stock' => 'required',
            'product_desc'  => 'required'
        ]);

        if ($validation->fails()) 
        {
            return Redirect::route(strtolower($this->controller_name) . '.create_iklan')
                        ->withInput()
                        ->withErrors($validation)
                        ->with('message', 'There were validation errors.');
        } 
        else 
        {
            $file = $request->file('upload_image');

            if ($file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png')
            {
                $data = array(
                    'product_name'      => $request->input('product_name'),
                    'product_desc'      => $request->input('product_desc'),
                    'currency'          => $request->input('currency'),
                    'product_price'     => $request->input('product_price'),
                    'product_stock'     => $request->input('product_stock'),
                    'status'            => 1,
                    'product_category'  => $request->input('category'),
                    'iklan'             => 1,
                    'user_id'           => session('id'),
                    'flag'              => 0
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
                        return redirect()->route('iklan.create_iklan')->with('success', 'OK ,Data Success Inserted !!');
                    }
                    else
                    {
                        return redirect()->route('iklan.create_iklan')->with('wrong', 'Hmm, Something Wrong!!');
                    }
                }
                else
                {
                    return redirect()->route('iklan.create_iklan')->with('failed', 'Data failed insert, Please Check!!'); 
                }

                
            }
            else
            {
                return redirect()->route('iklan.create_iklan')->with('error-img', 'So Sorry Your Image Not Match With Our Rules !');
            }
        }
    }

}
