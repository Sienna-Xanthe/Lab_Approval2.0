<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\addRequest;
use App\Http\Requests\SuperAdmin\deleteRequest;
use App\Http\Requests\SuperAdmin\formComboBoxfRequest;
use App\Http\Requests\SuperAdmin\formComboBoxRequest;
use App\Http\Requests\SuperAdmin\formExportRequest;
use App\Http\Requests\SuperAdmin\formLookRequest;
use App\Http\Requests\SuperAdmin\formSearchRequest;
use App\Http\Requests\SuperAdmin\formShowRequest;
use App\Http\Requests\SuperAdmin\idRequest;
use App\Http\Requests\SuperAdmin\idShowRequest;
use App\Http\Requests\SuperAdmin\modelShowRequest;
use App\Http\Requests\SuperAdmin\nameModelRequest;
use App\Http\Requests\SuperAdmin\returnRequest;
use App\Http\Requests\SuperAdmin\terminationRequest;
use App\Http\Requests\SuperAdmin\updateRequest;
use App\Models\SuperAdminEquipment;
use App\Models\SuperAdminForm;
use App\Models\SuperAdminInventory;
use App\Models\SuperAdminList;
use App\Models\SuperAdminRun;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /***
     * 表单管理
     * 表单数量
     */
    //表单数量统计-总数
//    public function getCount(){
//        $res =SuperAdminForm::yjx_getCount();
//        return $res ?
//            json_success('查询成功!', $res, 200) :
//            json_fail('查询失败!', null, 100);
//    }
//    表单审批-5个状态
    public function  getState(){
        $res['total'] =SuperAdminForm::yjx_getCount();//全部
        $res['pending'] =SuperAdminForm::yjx_getPending();//待审批
        $res['not'] =SuperAdminForm::yjx_getNotThrough();//未通过
        $res['pass'] =(int)SuperAdminForm::yjx_getThrough();//已通过
        $res['ing'] =(int)SuperAdminForm::yjx_getThroughing();//审批中
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
//    //表单数量统计-待审批
//    public function  getPending(){
//        $res =SuperAdminForm::yjx_getPending();
//        return $res ?
//            json_success('查询成功!', $res, 200) :
//            json_fail('查询失败!', null, 100);
//    }
//    //表单数量统计-未通过
//    public function getNotThrough(){
//        $res =SuperAdminForm::yjx_getNotThrough();
//        return  $res ?
//            json_success('查询成功!',$res, 200) :
//            json_fail('查询失败!',null, 100);
//    }
//    //表单数量统计-已通过
//    public  function getThrough(){
//        $res =SuperAdminForm::yjx_getThrough();
//        if ($res==0){
//            $a='0';
//            $res=1;
//        }
//        return $res ?
//            json_success('查询成功!', (int)$a, 200) :
//            json_fail('查询失败!', null, 100);
//    }
//    //表单数量统计-审批中
//    public  function getThroughing(){
//        $res =SuperAdminForm::yjx_getThroughing();
//        return $res ?
//            json_success('查询成功!', $res, 200) :
//            json_fail('查询失败!', null, 100);
//    }
    /***
     * 表单管理
     * 查看申请表-展示和下拉框的全部
     */
    //展示信息
    public function queryFormAll(){
        $res= $res=SuperAdminForm::yjx_getFormAll();;
        return $res ?
            json_success('查找成功!', $res, 200) :
            json_fail('查找失败!', null, 100);
    }
    //下拉框查询--表单名称+状态
    //字段 form_name_id state 状态
    public function  formComboBoxs(formComboBoxRequest $request){
            //未审批
        $form_name_id=$request['form_name_id'];
        if ($request['state']==0){
            $res=SuperAdminForm::yjx_getFormComboBoxP($form_name_id);
        } //未通过
        elseif($request['state']==1){
            $res=SuperAdminForm::yjx_getFormComboBoxNot($form_name_id);
        } //已通过
        elseif ($request['state']==2){
            $res=SuperAdminForm::yjx_getFormComboBoxYes($form_name_id);
        } //审批中
        elseif ($request['state']==3){
            $res=SuperAdminForm::yjx_getFormComboBoxing($form_name_id);
        } //全部
        else {
            $res=SuperAdminForm::yjx_getFormAll();
        }
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    //下拉框查询-表单名称+状态
//   字段 form_name_id
//    public function formComboBoxf(formComboBoxfRequest  $request){
//        $res=SuperAdminForm::yjx_formComboBoxf($request);
//        return $res ?
//            json_success('操作成功!', $res, 200) :
//            json_fail('操作失败!', null, 100);
//    }

    //搜索框 表单编号
//    字段 form_id
    public function formSearch(formSearchRequest  $request){
        $res=SuperAdminForm::yjx_getSearch($request);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    //查看-申请表
//    字段 form_id
    public function formLookApply(formLookRequest $request){
        $res=SuperAdminForm::yjx_lookForm($request);
        return $res ?
            json_success('查看成功!', $res, 200) :
            json_fail('查看失败!', null, 100);
    }
//    //查看后是否通过  --通过
//    public function formJudgePass(formJudgePassRequest $request){
//        $res=SuperAdminForm::yjx_formJudgePass($request);
//        return $res ?
//            json_success('操作成功!', null, 200) :
//            json_fail('操作失败!', null, 100);
//    }
//    //查看后是否通过  --不通过
//    public function formJudgeNotPass(formJudgeNotPassRequest $request){
//        $res=SuperAdminForm::yjx_formJudgeNotPass($request);
//        return $res ?
//            json_success('操作成功!', null, 200) :
//            json_fail('操作失败!', null, 100);
//    }
//    //查看后不通过的原因
//    //--传入字段-id --form_reason
//    public function formNotReason(formNotReasonRequest  $request){
//        $res =SuperAdminForm::yjx_formNotReason($request);
//        return $res ?
//            json_success('操作成功!', null, 200) :
//            json_fail('操作失败!', null, 100);
//    }

    //终止
//    字段 form_id
    public function termination(terminationRequest $request){
        $res=SuperAdminForm::yjx_termination($request);
        return $res ?
            json_success('终止成功!', null, 200) :
            json_fail('终止失败!', null, 100);
    }

    //导出
    //    字段 form_id    form_name_id
    public function formExport(formLookRequest $request){
        $res=SuperAdminForm::yjx_lookForm($request);
        return $res ?
            json_success('导出成功!', $res, 200) :
            json_fail('导出失败!', null, 100);
    }
    //展示-记录表
    //
    public function formShowRecord(){
        $res=SuperAdminRun::yjx_formShowRecord();
        return $res ?
            json_success('查看成功!', $res, 200) :
            json_fail('查看失败!', null, 100);
    }
    //设备管理-展示
    //    字段
    public function inventoryShow(){
        $res=SuperAdminInventory::yjx_inventoryShow();
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    //设备管理-下拉框-型号
    //    字段 inventory_name
    public function inventory_modelName(modelShowRequest $request){
        $res=SuperAdminInventory::yjx_modelShow($request);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }

    //设备管理-搜索框-表单编号
    //    字段 id
    public function inventory_idShow(idShowRequest $request){
        $res=SuperAdminInventory::yjx_idShow($request);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    //设备管理-新增
    //    字段 inventory_name,inventory_model, inventory_sum,inventory_attachment
    public function inventory_add(addRequest $request){
        $res=SuperAdminInventory::yjx_inventoryAdd($request);
        return $res ?
            json_success('增加成功!', null, 200) :
            json_fail('增加失败!', null, 100);
    }
    //设备管理-修改
    //    字段 inventory_sum id
    public function inventory_update(updateRequest $request){
        $res=SuperAdminInventory::yjx_inventoryUpdate($request);
        return $res ?
            json_success('修改成功!', null, 200) :
            json_fail('修改失败!', null, 100);
    }
    //设备管理-删除
    //    字段 id
    public function inventory_delete(deleteRequest $request){
        $res=SuperAdminInventory::yjx_inventoryDelete($request);
        return $res ?
            json_success('删除成功!', null, 200) :
            json_fail('删除失败!', null, 100);
    }
    //设备归还校验-名称型号下拉框
    //    字段 inventory_name,inventory_model
    public function inventory_nameModel(nameModelRequest $request){
        $res=SuperAdminList::yjx_inventoryNameModel($request);

        return $res ?
            json_success('查找成功!', $res, 200) :
            json_fail('查找失败!', null, 100);
    }
    //设备归还校验-表单编号查询
    //    字段 id
    public function inventory_id(idRequest $request){
        $res=SuperAdminList::yjx_inventoryId($request);
        return $res ?
            json_success('查找成功!', $res, 200) :
            json_fail('查找失败!', null, 100);
    }
    //设备归还校验-归还
    //    字段 id
    public function inventory_return(returnRequest $request){
        $res=SuperAdminList::yjx_inventoryReturn($request);
        return $res ?
            json_success('归还成功!', null, 200) :
            json_fail('归还失败!', null, 100);
    }



}
