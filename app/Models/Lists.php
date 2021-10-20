<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table = "list";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
