<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminRun extends Model
{
    //run
    protected $table = "run";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /***
     *表单管理-查看记录表
     *
     */
    public static function yjx_formShowRecord(){
        try {
            $res = self::select('run_id','run_week','run_time','run_class','run_name',
                'run_number','run_cname','run_type','run_teacher','run_situation','run_note')->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}
