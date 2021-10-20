<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table = "lab";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


    /**
     * 通过实验室名称查找所有实验室
     * @author zqz
     * @param $id
     * @param $name
     * @return false
     */
    public static function establishphoto($name)
    {
        try {

            $a=strtotime("now");
            $cc=self::join('time','time.lab_id','=','lab.id')->select('lab.id','lab_state1','time_start_time','time_end_time')->get();

            foreach ($cc as $item) {
                $b=strtotime($item->time_start_time);
                $c=strtotime($item->time_end_time);
                if ($a>=$b&&$a<=$c){
                   $f= $item->id;
                    self::where('id',$f)->update(['lab_state1'=>'1']);
                }else{
                    $f= $item->id;
                    self::where('id',$f)->update(['lab_state1'=>'0']);
                }
           }
            if ($name==null){
                $res=self::select('lab_id','lab_name','lab_state1','lab_state2')->get();
            }else{
                $res=self::select('lab_id','lab_name','lab_state1','lab_state2')->where('lab_name',$name)->get();
            }
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
            return false;
        }
    }


    /**
     * 新增实验室
     * @author zqz
     * @param $id
     * @param $name
     * @return false
     */
    public static function establishphoto1($id,$name)
    {
        try {
            $a=self::select('lab_id')->where('lab_id','=',$id)->value('lab_id');
            if ($a==null){
                $res=self::create(
                    [
                        'lab_id'       => $id,
                        'lab_name'     => $name,

                    ]);
            }

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function establishphoto2($id,$state)
    {
        try {

            $res=self::where('lab_id','=',$id)->update(['lab_state2'=>$state]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
            return false;
        }
    }
}
