<?php

namespace App\Weui;

use Illuminate\Database\Eloquent\Model;

class AddressModels extends Model
{
    public $table = "cs_address";
    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $primaryKey = 'address_id';
    protected $guarded = [];
    // protected $fillable = ['address_name','user_id','consignee',"email","country",];
}
