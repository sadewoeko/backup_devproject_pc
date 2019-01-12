<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;


class catalogues_product extends Model {
    
    protected $table = 'catalogues';
    protected $guarded = [];
    
    public $timestamp = true;

    public static function catalogues_product() {
        $conn = DB::connection('mysql');
        $sql = "SELECT a.flag,a.id,a.product_name,a.product_desc,a.product_price,a.product_stock,c.category,b.image
                FROM catalogues a JOIN catalogue_images b ON a.id = b.catalogue_id JOIN catagories c
                ON a.product_category = c.id ORDER BY a.id DESC";
        $execute = $conn->select($sql);
        //$content = $execute->paginate(3);
       // var_dump($execute);die();
        $result = $execute;
        $content['datas'] = $result;

        return $content;
    }


}
