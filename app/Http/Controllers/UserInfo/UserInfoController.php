<?php


namespace App\Http\Controllers\UserInfo;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfo\emailRequest;
use App\Http\Requests\UserInfo\judgeAccount2Request;
use App\Http\Requests\UserInfo\modifyPasswordRequest;
use App\Http\Requests\UserInfo\showRequest;
use App\Http\Requests\UserInfo\skipRouteRequest;
use App\Models\Account;
use App\Models\Imformatioin;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;




class UserInfoController extends Controller
{
    /**
     * 个人信息展示
     * @param  showRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(showRequest $request)
    {
        $id = auth('api')->user()->id;
        $res = Imformatioin::lyt_getInfoById($id);
        return $res ?
            json_success('显示个人信息成功!', $res, 200) :
            json_fail('显示个人信息失败!', null, 100);
    }

    /**
     * 判断account_state2的值为多少
     * @return \Illuminate\Http\JsonResponse
     */
    public function judgeAccount2(judgeAccount2Request $request)
    {
        $id  = auth('api')->user()->id;
        $res = Login::lyt_getAccount($id);
        return $res ?
            json_success('判断account_state2成功', $res, 200) :
            json_fail('判断account_state2失败!', null, 100);
    }


    /**
     * 修改密码
     * @param  modifyPasswordRequest  $request
     */
    public function modifyPassword(modifyPasswordRequest $request)
    {
        //通过token获取id
        $id = auth('api')->user()->id;
        //接受密码
        $newPassword     = $request['newPassword'];
        $confirmPassword = $request['confirmPassword'];

        if ($newPassword == $confirmPassword){
            $newBcrypt = bcrypt($newPassword);
            $res=Login::lyt_updatePassword($id, $newBcrypt);
        }
        return $res ?
            json_success('密码修改成功', $res, 200) :
            json_fail('密码修改失败!', null, 100);
    }


    /**
     * 发送邮件
     * @param  emailRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function email(emailRequest $request)
    {

        $id  = auth('api')->user()->id;
        $res            = Imformatioin::lyt_getInfoByEmail($id);
        $b            = json_decode($res);
        $studentEmail = $b[0]->register_email;
        //发送邮箱后，更改状态
        Mail::raw("https://baomidou.com/guide/", function ($message) use ($studentEmail) {
            $message->subject("用户校验");
            $message->to($studentEmail);
        });
        return $res ?
            json_success('获取邮箱成功!', $res, 200) :
            json_fail('获取邮箱失败!', null, 100);
    }

    /**
     * 跳转路由
     * @param  skipRouteRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function skipRoute(skipRouteRequest $request) {
        $id = auth('api')->user()->id;
        $sta = 3;
        $res = Login::lyt_updateAdminState($id, $sta);
        return $res ?
            json_success('状态码更改成功!', $res, 200) :
            json_fail('状态码更改失败!', null, 100);
    }

}
