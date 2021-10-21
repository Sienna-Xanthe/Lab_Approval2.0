<?php


namespace App\Http\Controllers\SuperAdmin;

use App\Http\Requests\SuperAdmin\modifyPassword2Request;
use App\Http\Requests\SuperAdmin\renewAdminStateRequest;
use App\Http\Requests\SuperAdmin\showAllPositionRequest;
use App\Http\Requests\SuperAdmin\showAllRequest;
use App\Http\Requests\SuperAdmin\showInfoByNameRequest;
use App\Models\Account;
use App\Models\Imformatioin;
use App\Models\Login;
use Illuminate\Http\Request;

class ManagementStuController
{
    /**
     * 展示所有管理员的个人信息
     * @param  showAllRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAll(showAllRequest $request)
    {
        $res = Imformatioin::lyt_getAllInfo();
        return $res ?
            json_success('显示所有成功!', $res, 200) :
            json_fail('显示所有失败失败!', null, 100);
    }

    /**
     * 按照职位分类显示管理员信息
     * @param  showAllPositionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllPosition(showAllPositionRequest $request)
    {
        $position = $request['position'];

        $res = Imformatioin::lyt_getAllPosition($position);

        return $res ?
            json_success('按职位显示成功!', $res, 200) :
            json_fail('按职位显示失败!', null, 100);
    }

    /**
     * 更新管理员状态
     * @param  renewAdminStateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function renewAdminState(renewAdminStateRequest $request)
    {
        $number  = $request['number'];
        $aid       = Login::lyt_getAdminState($number);
//        $b       = json_decode($a);
//        $stateId = $b[0]->account_state1;
//        $aid       = Login::lyt_getUserAid($number);
//        $bid       = json_decode($aid);
//        $accountId = $bid[0]->account_id;

        $s = "";

        if ($aid == 1) {
            $s = 2;
        } elseif ($aid == 2) {
            $s = 1;
        }

        if ($aid == 3) {
            $s = 4;
        } elseif ($aid == 4) {
            $s = 3;
        }


        $res = Login::lyt_updateAdminState2($number, $s);

        return $res ?
            json_success('更新状态成功!', $res, 200) :
            json_fail('更新状态失败!', null, 100);
    }

    /**
     * 根据姓名查询信息
     * @param  showInfoByNameRequest  $request
     * @return mixed
     */
    public function showInfoByName(showInfoByNameRequest $request)
    {
        $name = $request['name'];
        $res  = Imformatioin::lyt_getInfoByName($name);

        return $res ?
            json_success('通过name查询成功!', $res, 200) :
            json_fail('通过name查询失败!', null, 100);
    }

    /**
     * 修改密码2
     * @param  modifyPassword2Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modifyPassword2(modifyPassword2Request $request)
    {
        $number  = $request['number'];
        $newPassword = bcrypt($request['newPassword']);
        $res = Login::lyt_updatePassword2($number, $newPassword);
        return $res ?
            json_success('修改成功!', $res, 200) :
            json_fail('修改失败!', null, 100);
    }

    /**
     * 添加管理员的个人信息
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAdmin(Request $request)
    {
        $name  = $request['name'];
        $email = $request['email'];
        $phone = $request['phone'];

        $position = $request['position'];
        $number   = $request['number'];
        $password = bcrypt($request['password']);


        $a  = Login::insertAdmin($position, $number, $password);
        $b  = json_decode($a);
        $id = $b[count($b) - 1]->id;
        $res = Imformatioin::insertAdmin($id, $name, $email, $phone);

        return $res ?
            json_success('添加成功!', $res, 200) :
            json_fail('添加失败!', null, 100);
    }



}
