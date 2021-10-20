<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected  $table = 'time';
    public $timestamps = true ;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
