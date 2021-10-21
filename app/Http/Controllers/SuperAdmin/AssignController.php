<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfo\Registered;
use App\Models\User;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    /**
     * 分配账号
     * @param Registered $registeredRequest
     *      ['password'] => 密码
     *      ['login_number'] => 工号
     *      ['position_id'] => 职位id
     *      ['register_name'] => 姓名
     *      ['register_email'] => 邮箱
     *      ['register_phone'] => 电话
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function assign(Registered $registeredRequest)
    {
        $count = User::checknumber($registeredRequest);
        if ($count == 0) {
            $login_id = User::createUser(self::userHandle($registeredRequest));
            if ($login_id) {
                return User::saveImformation($registeredRequest, $login_id) ?
                    json_success('分配成功!', null, 200) :
                    json_success('分配失败!', null, 100);
            } else {
                return
                    json_success('分配失败!', null, 100);
            }
        } else {
            return
                json_success('分配失败!该工号已经注册过了！', null, 100);
        }
    }

        protected function userHandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['login_number'] = $registeredInfo['login_number'];
        $registeredInfo['position_id'] = $registeredInfo['position_id'];
        $registeredInfo['account_id'] = 1;


        return $registeredInfo;
    }
}
