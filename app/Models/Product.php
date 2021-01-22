<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','department_id','product_type_id','description','is_certified','standard_id','creator_id','updater_id'];

    //DEPARTMENT
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id')->withDefault(['name' => 'Undefined']);
    }

    //STANDARD
    public function standard()
    {
        return $this->belongsTo(Standard::class,'standard_id','id')->withDefault(['name' => 'Undefined']);
    }

    //PRODUCT TYPE
    public function productType()
    {
        return $this->belongsTo(ProductType::class,'product_type_id','id')->withDefault(['name' => 'Undefined']);
    }
}
