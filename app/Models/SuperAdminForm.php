<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminForm extends Model
{
    //form 表
    protected $table = "form";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


    /***
     * 表单数量统计-总数
     */
    public static function yjx_getCount(){
        try {
            $res =self::select()->count();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单数量统计-未审批
     */
    public static function  yjx_getPending(){
        try {
            $res = self::select()->where("form_state1",0)->count();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单数量统计-未通过
     */
    public static function yjx_getNotThrough(){
        try {
            $res1 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",1)->count();
            $res2 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",1)->count();
            $res3 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",2)
                ->where("form_state3",1)->count();
            $res=$res1+$res2+$res3;
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 表单数量统计-已通过
     */
    public static function yjx_getThrough(){
        try {
            $res = self::select("form_state1","form_state2","form_state3")
                ->where("form_state3",2)->count();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单数量统计-审批中
     */
    public static function yjx_getThroughing(){
        try {
            $res2 =self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",0)->count();
            $res3 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",0)->count();
            $res=$res2+$res3;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单管理-查看申请表-展示全部
     */
    public static function yjx_getFormAll(){
        try {
            $res = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 表单管理-查看申请表-下拉框-待审批
     */
    public static function yjx_getFormComboBoxP($form_name_id){
        try {
            $res = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state1",0)
                ->where('form_name_id',$form_name_id)
                ->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单审批-下拉框-未通过
     */
    public static function yjx_getFormComboBoxNot($form_name_id){
        try {
            $res1 = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state1",1)->where('form_name_id',$form_name_id)
                ->get();
            $res2 = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state1",2)->where("form_state2",1)->where('form_name_id',$form_name_id)
                ->get();
            $res3 = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",1)
                ->where('form_name_id',$form_name_id)->get();
            $res['res1']=$res1;
            $res['res2']=$res2;
            $res['res3']=$res3;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单管理-查看申请表-下拉框-已通过
     */
    public static function yjx_getFormComboBoxYes($form_name_id){
        try {
            $res = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state3",2)->where('form_name_id',$form_name_id)
                ->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单管理-查看申请表-下拉框-审批中
     */
    public static function yjx_getFormComboBoxing($form_name_id){
        try {
            $res1 = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state1",2)->where("form_state2",0)
                ->where('form_name_id',$form_name_id)->get();
            $res2 = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",0)
                ->where('form_name_id',$form_name_id)->get();
            $res['res1']=$res1;
            $res['res2']=$res2;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
//    /***
//     * 表单管理-查看申请表-下拉框-表单名
//     */
//    public static function yjx_formComboBoxf($request){
//        try {
//              $form_name_id=$request['form_name_id'];
//            $res= self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
//                ->where('form_name_id',$form_name_id)->get();
//            return $res ?
//                $res :
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
    /***
     * 表单管理-查看申请表-搜索框
     * 通过表单名称
     */
    public static function yjx_getSearch($request){
        $form_id=$request['form_id'];
        try {
            $res = self::select("form_id","form_name_id","created_at","form_state1","form_state2","form_state3",'form_state4')
                ->where("form_id",$form_id)->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *表单管理-查看申请表
     * 查看
     */
    public static function yjx_lookForm($request){
        $step1=$request['form_name_id'];
        $step2=$request['form_id'];
        try {
            if ($step1==1){
                $res=SuperAdminOpen::select( "open_usereason", "open_projectname", "open_usetime1",
                    "open_usetime2", "open_applicant", "applicant_name", "applicant_id", "applicant_phone",
                    "applicant_work"
                )->join('applicant','applicant.open_id','=','id')
                    ->where('form_id',$step2)->get();
            }elseif ($step1==2){
                $res=SuperAdminEquipment::select( "equipment_department", "equipment_use", "equipment_usetime1",
                    "equipment_usetime2", "equipment_applicant", "equipment_phone", "inventory_name",
                    "inventory_model", "list_number", "list_attachment"
                )->join('list','list.equipment_id','equipment.id')
                    ->join('inventory','inventory.id','=','list.inventory_id')
                    ->where('form_id',$step2)->get();
            }else{
                $res=SuperAdminBorrow::select("borrow_time", "borrow_lname", "borrow_lid", "borrow_cname",
                    "borrow_number",'borrow_goal','borrow_promise','borrow_applicant','borrow_phone')
                    ->where('form_id',$step2)->get();
            }
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *表单管理-查看申请表
     * 终止
     */
    public static function yjx_termination($request){
        $id=$request['form_id'];
        try {
            $res = self::where("form_id",$id)
                ->update(
                    [
                        'form_state4'=>1
                    ]
                );
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }





}
