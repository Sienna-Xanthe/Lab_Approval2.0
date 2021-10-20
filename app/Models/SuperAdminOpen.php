<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminOpen extends Model
{
    //open
    protected $table = "open";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
