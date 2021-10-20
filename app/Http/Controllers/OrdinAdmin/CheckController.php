<?php

namespace App\Http\Controllers\OrdinAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrdinAdmin\CheckRequest;
use App\Models\Check;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    /**
     * 填写期末教学记录检查表
     * @author zqz
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_add(CheckRequest $request)
    {
        $check_id       = 'E'.date("ymdis");
        $id             = auth('api')->user()->id; //获取login_id
        $check_number   = $request['check_number'];
        $check_name     = $request['check_name'];
        $check_course   = $request['check_course'];
        $check_teacher  = $request['check_teacher'];
        $check_teaching = $request['check_teaching'];
        $check_running    = $request['check_running'];
        $check_note     = $request['check_note'];
        $res=Check::establishphoto10($check_id,$id,$check_number,$check_name,$check_course,$check_teacher,$check_teaching,$check_running,$check_note);
        return $res ?
            json_success('添加成功!', null, 200) :
            json_fail('添加失败!', null, 100);
    }

    /**
     * 查询所有的期末教学记录检查表
     * @author
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_select()
    {
        $res=Check::establishphoto11();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

}
