<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



class currency extends Model {
    
    protected $table = 'currency';
    protected $guarded = [];
    
    public $timestamp = false;


}
