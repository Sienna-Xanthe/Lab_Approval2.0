<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $table = 'login';
    protected $guarded = [];
    public $timestamps = true;
    public $hidden = ['password'];

    /**
     * 得到用户的状态
     * @param $aid
     */
    public static function lyt_getAccount($id)
    {
        try {
            $res = self::join('account', 'account.id', 'account_id')
                ->where('login.id', '=', $id)
                ->get('account.account_state2');
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 修改密码
     * @param $id
     * @param $newPassword
     * @return false
     */
    public static function lyt_updatePassword($id, $newPassword)
    {
        try {
            $res = self::where('login.id', '=', $id)
                ->update([
                    'password' => $newPassword
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 查看管理员的状态
     * @return false
     */
    public static function lyt_getAdminState($number)
    {
        try {
            $res = self::join('account', 'account.id', 'account_id')
                ->where('login_number', '=', $number)
                ->select('account.account_state1')
                ->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 根据num获取account_id
     * @return false
     */
    public static function lyt_getUserAid($number)
    {
        try {
            $res = self::where('login_number', '=', $number)
                ->select('account_id')
                ->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 修改密码2
     * @param $id
     * @param $newPassword
     * @return false
     */
    public static function lyt_updatePassword2($number, $newPassword)
    {
        try {
            $res = self::where([
                'login_number' => $number,
            ])
                ->update([
                    'password' => $newPassword
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 添加管理员的私密信息
     * @return false
     */
    public static function insertAdmin($position, $number, $password)
    {
        try {
            $res = self::insert([
                'login.position_id'  => $position,
                'login.login_number' => $number,
                'login.password'     => $password,
            ]);

            $res = self::select([
                'id',
                'account_id'
            ])
                ->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * id获取account_id
     * @return false
     */
    public static function lyt_getAid($id)
    {
        try {
            $res = self::where('login.id', '=', $id)
                ->select('account_id')
                ->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


}
