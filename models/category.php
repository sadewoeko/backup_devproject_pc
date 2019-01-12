<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



class category extends Model {
    
    protected $table = 'catagories';
    protected $guarded = [];
    
    public $timestamp = false;


}
