<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company_name', 
        'address_company',
        'office_phone',
        'office_phone2',
        'desc_company',
    ];
}