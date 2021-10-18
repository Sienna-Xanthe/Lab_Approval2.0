<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imformatioin extends Model
{
    protected $table = "register";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
