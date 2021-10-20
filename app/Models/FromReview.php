<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class FromReview extends Model
{

    protected  $table = 'form';
    public $timestamps = true ;
    protected $primaryKey = 'id';
    protected $guarded = [];


    /**
     * *管理员通过审批状态与表单名称查看提交表单
     * @author zqz
     * @param $position_id
     * @param $state
     * @return false
     */
    public static function establishphoto($form_name,$position_id,$state)
    {
        try {

            if ($position_id==2){
                if ($form_name==null&&$state!=null){
                    $res=self::select('form_id','form_name_id','created_at','form_state1')
                        ->where('form_state1',$state)->get();
                }elseif ($form_name!=null&&$state==null){
                    $res=self::select('form_id','form_name_id','created_at','form_state1')
                        ->where('form_name_id',$form_name)->get();
                }elseif($form_name==null&&$state==null){
                    $res=self::select('form_id','form_name_id','created_at','form_state1')->get();
                }else{
                    $res=self::select('form_id','form_name_id','created_at','form_state1')
                        ->where('form_state1',$state)->where('form_name_id',$form_name)->get();
                }

            }
            elseif ($position_id==3){

                if ($form_name==null&&$state!=null){
                    $res=self::select('form_id','form_name_id','created_at','form_state2')
                        ->where('form_state2',$state)->where('form_state1','=','2')->get();
                }elseif ($form_name!=null&&$state==null){
                    $res=self::select('form_id','form_name_id','created_at','form_state2')
                        ->where('form_name_id',$form_name)->where('form_state1','=','2')->get();
                }elseif ($form_name==null&&$state==null){
                    $res=self::select('form_id','form_name_id','created_at','form_state2')
                        ->where('form_state1','=','2')->get();
                }
                else{
                    $res=self::select('form_id','form_name_id','created_at','form_state2')
                        ->where('form_state2',$state)->where('form_name_id',$form_name)
                        ->where('form_state1','=','2')->get();
                }

            }elseif ($position_id==4){

                if ($form_name==null&&$state!=null){
                    $res=self::select('form_id','form_name_id','created_at','form_state3')
                        ->where('form_state3',$state)->where('form_state2','=','2')->get();
                }elseif ($form_name!=null&&$state==null){
                    $res=self::select('form_id','form_name_id','created_at','form_state3')
                        ->where('form_name_id',$form_name)->where('form_state2','=','2')->get();
                }elseif ($form_name==null&&$state==null){
                    $res=self::select('form_id','form_name_id','created_at','form_state3')
                        ->where('form_state2','=','2')->get();
                }
                else{
                    $res=self::select('form_id','form_name_id','created_at','form_state3')
                        ->where('form_state3',$state)->where('form_name_id',$form_name)
                        ->where('form_state2','=','2')->get();
                }

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
     * 管理员审批表单通过还是未通过
     * @author zqz
     * @param $position_id
     * @param $form_reason
     * @param $state
     * @return false
     */
    public static function establishphoto0($id,$form_id,$position_id,$form_reason,$state)
    {
        try {
            if ($state==1) {
                Reason::create(
                    [
                        'reasons' => $form_reason,
                    ]
                );
                $bb = Reason::latest()->value('id');

                $cc = self::where('form_id', $form_id)->update(['reason_id' => $bb]);

                $b = self::where('form_id', $form_id)->value('form_name_id');

                if ($b==2){
                    $c=self::join('borrow','borrow.form_id','=','form.form_id')
                        ->where('borrow.form_id',$form_id)->value('borrow_lid');
                    $j=Lab::join('time','time.lab_id','=','lab.id')->where('time.lab_id',$c)->value('time.id');
                    Time::where('id',$j)->delete();
                }

            }

            $d=Imformatioin::where('login_id',$id)->value('register_name');
            if ($position_id==2){
                $res = self::where('form_id',$form_id)->
                update(['form_state1'=>$state,'form_name1'=>$d]);

                $e=self::where('form_id',$form_id)->value('updated_at');

                self::where('form_id',$form_id)->
                update(['form_time1'=>$e]);
            }
            elseif ($position_id==3){
                $res = self::where('form_id',$form_id)->
                update(['form_state2'=>$state,'form_name2'=>$d]);

                $e=self::where('form_id',$form_id)->value('updated_at');

                self::where('form_id',$form_id)->
                update(['form_time2'=>$e]);

            }elseif ($position_id==4){
                $res = self::where('form_id',$form_id)->
                update(['form_state3'=>$state,'form_name3'=>$d]);

                $e=self::where('form_id',$form_id)->value('updated_at');

                self::where('form_id',$form_id)->
                update(['form_time3'=>$e]);
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
     * 管理员通过查询表单编号查看提交表
     * @author zqz
     * @param $position_id
     * @param $form_id
     * @return false
     */
    public static function establishphoto5($position_id,$form_id)
    {
        try {

            if ($position_id==2){
                $res = self::select('form_id','form_name_id','created_at','form_state1')
                    ->where('form_id',$form_id)->get();
            }
            elseif ($position_id==3){
                $res = self::select('form_id','form_name_id','created_at','form_state2')
                    ->where('form_id',$form_id)->where('form_state1','=','2')->get();
            }elseif ($position_id==4){
                $res = self::select('form_id','form_name_id','created_at','form_state3')
                    ->where('form_id',$form_id)->where('form_state2','=','2')->get();
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
     * * 管理员查看表单详情
     * @author zqz
     * @param $id
     * @param $form_name
     * @return array|false
     */
    public static function establishphoto2($form_id,$form_name)
    {
        try {
            if ($form_name==1){
                $res['a']=self::join('equipment','equipment.form_id','=','form.form_id')
                    ->select('equipment_department','equipment_use','equipment_usetime1','equipment_usetime2','equipment_applicant','equipment_phone')
                    ->where('equipment.form_id',$form_id)
                    ->get();

                $a=self::join('equipment','equipment.form_id','=','form.form_id')
                    ->where('equipment.form_id',$form_id)->value('equipment.id');


                $b=Lists::where('list.equipment_id',$a)->pluck('inventory_id');

                foreach ($b as $item) {
                    $res['b'][]=Lists::join('inventory','list.inventory_id','=','inventory.id')
                        ->select('inventory_name','inventory_model','list_number','list_attachment')
                        ->where('list.equipment_id',$a)->where('inventory.id',$item)
                        ->get();
                }

                $b=self::where('form_id',$form_id)->value('reason_id');
                if ($b!=null){
                    $res['c']=self::join('reason','reason.id','=','form.reason_id')
                        ->select('reasons')->where('reason.id', $b)->get();
                }
            }elseif ($form_name==2){
                $res['a']=self::join('borrow','borrow.form_id','=','form.form_id')
                    ->select('borrow_time','borrow_lname','borrow_lid','borrow_cname','borrow_number','borrow_goal','borrow_promise','borrow_applicant','borrow_phone')
                    ->where('borrow.form_id',$form_id)
                    ->get();

                $b=self::where('form_id',$form_id)->value('reason_id');

                if ($b!=null){
                    $res['c']=self::join('reason','reason.id','=','form.reason_id')
                        ->select('reasons')->where('reason.id', $b)->get();
                }

            }elseif ($form_name==3){
                $res['a']=self::join('open','open.form_id','=','form.form_id')
                    ->select('open_usereason','open_projectname','open_usetime1','open_usetime2','open_applicant')
                    ->where('open.form_id',$form_id)
                    ->get();

                $a=self::join('open','open.form_id','=','form.form_id')
                    ->where('open.form_id',$form_id)->value('open.id');

                $res['b']=Open::join('applicant','open.id','=','applicant.open_id')
                    ->select('applicant_name','applicant_id','applicant_phone','applicant_work')
                    ->where('applicant.open_id',$a)
                    ->get();
                $b=self::where('form_id',$form_id)->value('reason_id');
                if ($b!=null){
                    $res['c']=self::join('reason','reason.id','=','form.reason_id')
                        ->select('reasons')->where('reason.id', $b)->get();
                }
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
     * 管理员表单数量总数量
     * @author zqz
     * @param $position_id
     * @return false
     */
    public static function establishphoto3($position_id)
    {
        try {
            if ($position_id==2){
                $res = self::select('id')->count();
            }
            elseif ($position_id==3){
                $res = self::select('id')
                     ->where('form_state1','=','2')->count();
            }elseif ($position_id==4){
                $res = self::select('id')
                    ->where('form_state2','=','2')->count();
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
     * 管理员查询表单中待审批，未通过，已通过的表单数量
     * @author zqz
     * @param $position_id
     * @return array|false
     */
    public static function establishphoto4($position_id)
    {
        try {
            if ($position_id==2){
                $res['a'] = self::select('id')->where('form_state1','=','0')->count();
                $res['b'] = self::select('id')->where('form_state1','=','1')->count();
                $res['c'] = self::select('id')->where('form_state1','=','2')->count();
            }
            elseif ($position_id==3){
                $res['a'] = self::select('id')->where('form_state2','=','0')->where('form_state1','=','2')->count();
                $res['b'] = self::select('id')->where('form_state2','=','1')->count();
                $res['c'] = self::select('id')->where('form_state2','=','2')->count();
            }elseif ($position_id==4){
                $res['a'] = self::select('id')->where('form_state2','=','0')->where('form_state2','=','2')->count();
                $res['b'] = self::select('id')->where('form_state2','=','1')->count();
                $res['c'] = self::select('id')->where('form_state2','=','2')->count();
            }
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查询错误', [$e->getMessage()]);
            return false;
        }
    }

//    /**
//     * 获取管理员对应的职位
//     * @param $student_id
//     * @return false
//     */
//    public static function positionChange($student_id)
//    {
//
//        try {
//            $row=self::join('student','student.id','=','form.student_id')
//                ->where('student.id',$student_id)->value('position_id');
//            return $row ?
//               $row:
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
}
