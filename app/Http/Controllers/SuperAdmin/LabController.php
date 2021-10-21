<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LabAddRequest;
use App\Http\Requests\SuperAdmin\LabEnableRequest;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * 通过实验室名称查找所有实验室
     * @author zqz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_name(Request $request)
    {
        $name=$request['lab_name'];
        $res=Lab::establishphoto($name);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }


    /**
     * 新增实验室
     * @author zqz
     * @param LabAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_add(LabAddRequest $request)
    {
        $id=$request['lab_id'];
        $name=$request['lab_name'];
        $res=Lab::establishphoto1($id,$name);
        return $res ?
            json_success('添加成功!', null, 200) :
            json_fail('添加失败!', null, 100);
    }


    /**
     * 将实验室开启或设为禁用状态
     * @author zqz
     * @param LabEnableRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_enable(LabEnableRequest $request)
    {
        $id=$request['lab_id'];
        $state=$request['lab_state2'];
        $res=Lab::establishphoto2($id,$state);
        return $res ?
            json_success('操作成功!', null, 200) :
            json_fail('操作失败!', null, 100);
    }
}
