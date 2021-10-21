<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected  $table = 'reason';
    public $timestamps = true ;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
