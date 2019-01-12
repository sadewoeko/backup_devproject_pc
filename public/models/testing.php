<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class testing extends Model implements AuditableContract
{
    use Auditable;
    
    public static $rules = array (
        'code' => 'required',
        'employee_name' => 'required'
    );
    protected $table = 'testing';
    protected $guarded = [];


//    public function Store (){
//        
//    }
    
    public function validate ($data){
        $validate = Validator::make($data,testing::$rules);
        return $validate;
    }
}
