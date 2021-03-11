<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;
    /*Fields*/
    protected $fillable = ['code','name','machine_type_id','department_id','machine_id','creator_id','updater_id'];
}
