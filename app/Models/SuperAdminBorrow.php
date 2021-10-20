<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminBorrow extends Model
{
    //borrow
    protected $table = "borrow";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
