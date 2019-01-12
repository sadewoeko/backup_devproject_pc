<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;



class catalogue_images extends Model {
    
    protected $table = 'catalogue_images';
    protected $guarded = [];
    
    public $timestamp = true;


}
