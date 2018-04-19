<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = array();
    
    public function producttype()
    {
    return $this->belongsTo('\App\Producttype','producttype_id');
    }

    public function supplier()
    {
    return $this->belongsTo('\App\Supplier','supplier_id');
    }


}
