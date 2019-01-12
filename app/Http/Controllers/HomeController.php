<?php

namespace App\Http\Controllers;

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

class HomeController extends Controller {

    public function index()
    {        
        $conn = DB::connection('mysql');
        $sql = "SELECT a.*,b.image,c.sortname FROM catalogues a 
                JOIN catalogue_images b ON b.catalogue_id = a.id
                JOIN users u ON a.user_id = u.id
                JOIN countries c ON c.id = u.country_id 
                WHERE MONTH(a.created_at) = MONTH(CURRENT_DATE()) AND a.iklan = 0 AND flag = 1 LIMIT 10";
        $res = $conn->select($sql);

        $inquiry = $res;

        $conn = DB::connection('mysql');
        $sql = "SELECT a.id,a.product_name, b.image FROM catalogues a
                JOIN catalogue_images b on a.id = b.catalogue_id
                where MONTH(a.created_at) = MONTH(CURRENT_DATE()) AND a.iklan = 0 AND flag = 1";
        $dataBuy = $conn->select($sql);
        $Buy = $dataBuy;

        $conn = DB::connection('mysql');
        $sql1 = "SELECT a.id,a.product_name, b.image FROM catalogues a
                JOIN catalogue_images b on a.id = b.catalogue_id
                where MONTH(a.created_at) = MONTH(CURRENT_DATE()) AND a.iklan = 0 AND flag = 0";
        $dataSell = $conn->select($sql1);
        $Sell = $dataSell;
        
        $products = DB::table('catalogues')
            ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
            ->join('catagories','catalogues.product_category','=','catagories.id')
            ->join('users', 'users.id', '=', 'catalogues.user_id')
            ->join('company', 'company.user_id', '=', 'users.id')
            ->where('catalogues.iklan', '=', 1)
            ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image','company.company_name')
            ->orderBy('catalogues.id')->paginate(12); 
            

        $categories = Category::get();

        $conn = DB::connection('mysql');
        $sql = "SELECT co.id as country_id, co.sortname, co.name, count(co.sortname) as total
                from catalogues c
                join users u on c.user_id = u.id
                join countries co on co.id = u.country_id 
                where MONTH(c.created_at) = MONTH(CURRENT_DATE()) AND c.iklan = 0 AND flag = 1
                group by co.id, co.sortname, co.name";
        $countriesRequest = $conn->select($sql);

        return view('advertisement', compact('products', 'categories', 'flag', 'country', 'countriesRequest','inquiry','Buy','Sell'));    

        
    }

    public function filter($flag = null, $country = null)
    {
        $products['flag'] = $flag;
        $products['country'] = $country;
        if ($flag != null && $flag != 'all') {
            $flagQuery = $flag == 'buy' ? 1 : 0;

            if ($country != null) {
                $products['datas'] = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->join('users', 'users.id', '=', 'catalogues.user_id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image', 'catalogues.currency', 'company.company_name', 'countries.name','countries.sortname')
                    ->where('flag', '=', $flagQuery)
                    ->where('users.country_id', '=', $country)
                    ->where('catalogues.iklan','=',0)
                    ->orderBy('catalogues.id','DESC')->paginate(10);
                     
            } else {
                $products['datas'] = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image', 'catalogues.currency', 'company.company_name', 'countries.name')
                    ->where('flag', '=', $flagQuery)
                    ->where('catalogues.iklan','=',0)
                    ->orderBy('catalogues.id')->paginate(10); 
            }

        } else {

            if ($country != null) {
                $currentMonth = date('m');
                $products['datas'] = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->join('users', 'users.id', '=', 'catalogues.user_id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->where('users.country_id', '=', $country)
                    ->where('catalogues.iklan','=',0)
                    ->whereRaw('MONTH(catalogues.created_at) = ?',[$currentMonth])                                       
                    ->select('users.id as user','catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image', 'catalogues.currency', 'company.company_name', 'countries.name', 'countries.sortname')
                    ->groupBy('catalogues.id')
                    ->orderBy('catalogues.id')->paginate(10);
            } else {
                $products['datas'] = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->where('catalogues.iklan','=',0)                    
                    ->select('catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image', 'catalogues.currency', 'company.company_name', 'countries.name')
                    ->orderBy('catalogues.id')->paginate(10);
            }

        }

        // dd($products);

        return view('productFilter', $products);
        
    }

    public function productDetail($id) 
    {
        if(empty(session('full_name'))) {
            // return redirect()->route('auth.sign-in')->with('authlog', 'Sorry You have to login to access this page!');
            $conn = DB::connection('mysql');
            $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.currency,a.product_price,a.payment,a.packaging,a.delivery,a.product_stock, b.image as images ,u.full_name,cm.company_name,cm.address_company,cm.desc_company,u.image as foto,u.country_id,u.state_id,u.city_id,u.address,c.category,b.image, co.name as negara, s.name as negaraa, city.name as kota
                    FROM catalogues a 
                    JOIN catalogue_images b ON a.id = b.catalogue_id
                    JOIN users u 
                    JOIN catagories c ON a.product_category = c.id 
                    JOIN countries co ON co.id = u.country_id
                    JOIN states s ON s.id = u.state_id
                    JOIN cities city ON city.id = u.city_id
                    JOIN company cm ON cm.user_id = u.id
                    WHERE a.id = ".$id." AND a.user_id = u.id
                    GROUP BY a.id";
            $execute = $conn->select($sql);
            $result = $execute;
            $content['data'] = $result[0];

            return view('productDetail', $content);
        }
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.currency,a.product_price,a.payment,a.packaging,a.delivery,a.product_stock, b.image as images ,u.full_name,u.email,cm.company_name,cm.address_company,cm.office_phone,cm.office_phone2,cm.desc_company,u.image as foto,u.country_id,u.state_id,u.city_id,u.cellphone,u.cellphone2,u.address,u.website,c.category,b.image, co.name as negara, s.name as negaraa, city.name as kota
                FROM catalogues a 
                JOIN catalogue_images b ON a.id = b.catalogue_id
                JOIN users u 
                JOIN catagories c ON a.product_category = c.id 
                JOIN countries co ON co.id = u.country_id
                JOIN states s ON s.id = u.state_id
                JOIN cities city ON city.id = u.city_id
                JOIN company cm ON cm.user_id = u.id
                WHERE a.id = ".$id." AND a.user_id = u.id
                GROUP BY a.id";
        $execute = $conn->select($sql);
        $result = $execute;
        $content['data'] = $result[0];

        return view('productDetail', $content);
    }

    public function productDetailBuy($id) 
    {
        if(empty(session('full_name'))) {
            // return redirect()->route('auth.sign-in')->with('authlog', 'Sorry You have to login to access this page!');
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.currency,a.product_price,a.product_stock, b.image as images ,cm.company_name,cm.address_company,cm.desc_company,u.website,c.category,b.image,u.image as foto,co.name as negara, s.name as negaraa, city.name as kota
                FROM catalogues a 
                JOIN catalogue_images b ON a.id = b.catalogue_id
                JOIN users u 
                JOIN catagories c ON a.product_category = c.id 
                JOIN countries co ON co.id = u.country_id
                JOIN states s ON s.id = u.state_id
                JOIN cities city ON city.id = u.city_id
                JOIN company cm ON cm.user_id = u.id
                WHERE a.id = ".$id." AND a.user_id = u.id";
        $execute = $conn->select($sql);
        $result = $execute;
        $content['data'] = $result[0];

        return view('productDetailBuy', $content);
        }
        $conn = DB::connection('mysql');
        $sql = "SELECT a.user_id,a.id,a.product_name,a.product_desc,a.currency,a.product_price,a.product_stock,a.product_origin,a.destination,a.pay_terms, b.image as images ,cm.company_name,cm.address_company,cm.office_phone,cm.office_phone2,cm.desc_company,u.email,u.cellphone,u.cellphone2,u.website,c.category,b.image,u.image as foto,co.name as negara, s.name as negaraa, city.name as kota
                FROM catalogues a 
                JOIN catalogue_images b ON a.id = b.catalogue_id
                JOIN users u 
                JOIN catagories c ON a.product_category = c.id 
                JOIN countries co ON co.id = u.country_id
                JOIN states s ON s.id = u.state_id
                JOIN cities city ON city.id = u.city_id
                JOIN company cm ON cm.user_id = u.id
                WHERE a.id = ".$id." AND a.user_id = u.id";
        $execute = $conn->select($sql);
        $result = $execute;
        $content['data'] = $result[0];

        return view('productDetailBuy', $content);
    }

    public function search(Request $request)
    {
        
        $keyword = $request->input('keyword');
        $flag = $request->input('flag');
        $content['flag'] = $flag;
        $content['keyword'] = $keyword;
        
        if ($flag == 'all') {
            $keywords = explode(' ', $keyword);
            $content['datas'] = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->join('users', 'users.id', '=', 'catalogues.user_id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->select('users.id as user','users.full_name','catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image','company.company_name','countries.name','countries.sortname')
                    // ->where('catalogues.product_name', 'LIKE', '%' . $keyword . '%')
                    ->where(function($query) use ($keywords){
                        foreach($keywords as $keyword){
                            $query->where('catalogues.product_name', 'LIKE', '%' .$keyword. '%');
                        }
                    }) 
                    ->orwhere('company.company_name', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('countries.name', 'LIKE', '%' . $keyword . '%')
                    ->orwhere('users.full_name', 'LIKE', '%' . $keyword . '%')
                    ->groupBy('catalogues.id')
                    ->orderBy('catalogues.id','desc')
                    ->paginate(12);

                    $categories = Category::get();
                    $content['categories'] = $categories;

                    return view('productSearch', $content);

        } elseif($flag=='company') {
            $content['datas'] = DB::table('users')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->select('users.id','users.image as img','users.full_name','countries.name','countries.id as cis','countries.sortname','company.company_name','company.desc_company')
                    ->where('company.company_name', 'LIKE', '%' . $keyword . '%')
                    ->groupBy('users.id','company.company_name','company.desc_company','users.image', 'countries.name','countries.id','countries.sortname')
                    ->orderBy('users.id','desc')
                    ->paginate(12);

                    $categories = Category::get();
                    $content['categories'] = $categories;
                    // return $content;
                    return view('companySearch', $content);

        } elseif($flag=='name'){
            $content['datas'] = DB::table('users')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->select('users.id','users.image as img','users.full_name','countries.name','countries.id as cis','countries.sortname','company.company_name','company.desc_company')
                    ->where('countries.name', 'LIKE', '%' . $keyword . '%')
                    ->groupBy('users.id','company.company_name','company.desc_company','users.image', 'countries.name','countries.id','countries.sortname')
                    ->orderBy('users.id','desc')
                    ->paginate(12);

                    $categories = Category::get();
                    $content['categories'] = $categories;
                    // return $content;
                    return view('countrySearch', $content);            
        
        } else {
            $flag = $flag == 'sell' ? 0 : 1;
            $content['datas'] = DB::table('catalogues')
                    ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
                    ->join('catagories','catalogues.product_category','=','catagories.id')
                    ->join('users', 'users.id', '=', 'catalogues.user_id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('company', 'company.user_id', '=', 'users.id')
                    ->select('catalogues.flag','catalogues.id','users.id as user','users.full_name','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image','company.company_name','countries.name','countries.sortname')
                    ->where('catalogues.product_name', 'LIKE', '%' . $keyword . '%')
                    ->where('catalogues.flag', $flag)
                    ->groupBy('catalogues.id')
                    ->orderBy('catalogues.id','desc')
                    ->paginate(12);
                      
                    
                    $categories = Category::get();
                    $content['categories'] = $categories;

                    return view('productSearch', $content);


        }
        
        
    }

    public function inquiryMonth() {
        
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function help()
    {
        return view('help');
    }

    public function member()
    {
        return view('member');
    }

    public function products()
    {
        return view('products');
    }

    public function product_all($flag)
    {
        $flag = $flag == 'buy' ? 1 : 0;
   
        $products = DB::table('catalogues')
            ->join('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
            ->join('catagories','catalogues.product_category','=','catagories.id')
            ->join('users', 'users.id', '=', 'catalogues.user_id')
            ->join('company', 'company.user_id', '=', 'users.id')
            ->join('countries', 'countries.id', '=', 'users.country_id')
            ->where('flag', '=', $flag)
            ->where('iklan', '=', 0 )
            ->select('users.full_name','catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image','company.company_name','catalogues.currency','countries.name','countries.sortname')
            ->groupBy('catalogues.id')
            ->orderBy('catalogues.id','DESC')->paginate(12); 

        return view('product_all', compact('products'));
    }

    public function byCategory($flag) {
        //dd($flag);
        $productscategory = DB::table('catalogues')
            ->leftJoin('catalogue_images','catalogues.id','=','catalogue_images.catalogue_id')
            ->leftJoin('catagories','catalogues.product_category','=','catagories.id')
            ->leftJoin('users', 'users.id', '=', 'catalogues.user_id')
            ->leftJoin('company','users.id','=','company.user_id')
            ->leftJoin('countries','countries.id','=','users.country_id')
            ->where('catalogues.iklan', '=', 0 )
            ->where('catagories.id','=',$flag)
            ->select('users.id as user','users.full_name','countries.name','countries.sortname','company.company_name','catalogues.flag','catalogues.id','catalogues.product_name','catalogues.product_desc','catalogues.product_price','catalogues.product_stock','catagories.category','catalogue_images.image', 'catalogues.currency')
            ->groupBy('catalogues.id')
            ->orderBy('catalogues.id','DESC')->paginate(12);

        $conn = DB::connection('mysql');
        $sql = "SELECT id,category FROM catagories WHERE id = ".$flag."";
        $execute = $conn->select($sql);
       
        //var_dump($execute);die();    
        
        //$dataCategory['datas'] = $productscategory;
        $categoryName = isset($productscategory[0]->category) ? $productscategory[0]->category : $execute[0]->category;
        //dd($productscategory);

        return view('categorydetail', compact('productscategory','categoryName'));
    }

    public function show_category()
    {
        $categories = Category::get();
        
        return view('show_category', compact('categories'));
    }
}
