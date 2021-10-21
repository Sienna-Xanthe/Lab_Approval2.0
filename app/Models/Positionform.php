<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Positionform extends Model
{
    //
    protected $table = "position";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function position()
    {

        try {
            $res = Positionform::select('id','positions')
                ->where('id','<>',5)
                ->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询失败！', [$e->getMessage()]);
            return false;
        }
    }
}
