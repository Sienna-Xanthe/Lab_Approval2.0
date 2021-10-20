<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $table = "check";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /**
     * 填写期末教学记录检查表
     * @author zqz
     * @return \Illuminate\Http\JsonResponse
     */
    public static function establishphoto10($check_id,$id,$check_number,$check_name,$check_course,$check_teacher,$check_teaching,$check_running,$check_note)
    {
        try {

            $c=Imformatioin::where('login_id',$id)->value('register_name');

            $res=Check::create(
                [
                    'check_id'       => $check_id,
                    'login_id'       => $id,
                    'check_number'   => $check_number,
                    'check_name'     => $check_name,
                    'check_course'   => $check_course,
                    'check_teacher'  => $check_teacher,
                    'check_teaching' => $check_teaching,
                    'check_running'  => $check_running,
                    'check_note'     => $check_note,
                    'check_recorder' => $c,
                ]
            );

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
            return false;
        }
    }


    /**
     * 查询所有的期末教学记录检查表
     * @author
     * @return \Illuminate\Http\JsonResponse
     */
    public static function establishphoto11()
    {
        try {
            $res=self::select('check_id','check_number','check_name','check_course','check_teacher','check_teaching','check_running','check_note','check_recorder')->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
            return false;
        }
    }
}
