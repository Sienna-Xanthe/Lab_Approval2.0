<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imformatioin extends Model
{
    protected $table = "register";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * 通过id得到个人信息
     * @param $id
     * @return false
     */
    public static function lyt_getInfoById($id)
    {
        try {
            $res = self::join('login', 'login.id', 'login_id')
                ->where('login_id','=',$id)
                ->select([
                    'register_name',
                    'register_email',
                    'register_phone',


                    'login.position_id',
                    'login.login_number'

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
     * 得到email
     * @param $id
     * @return false
     */
    public static function lyt_getInfoByEmail($id)
    {
        try {
            $res = self::where('login_id', '=', $id)
                ->get('register_email');
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 得到所有职位的个人信息
     * @return false
     */
    public static function lyt_getAllInfo()
    {
        try {
            $res = self::join('login', 'login.id', 'login_id')
                ->select([
                    'register_name',
                    'register_email',
                    'register_phone',


                    'login.position_id',
                    'login.login_number',
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
     * 根据职位得到的个人信息
     * @return false
     */
    public static function lyt_getAllPosition($position)
    {
        try {
            $res = self::join('login', 'login.id', 'login_id')
                ->where('login.position_id', '=', $position)
                ->select([
                    'register_name',
                    'register_email',
                    'register_phone',


                    'login.position_id',
                    'login.login_number',
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
     * 通过姓名得到个人信息
     * @param $id
     * @return false
     */
    public static function lyt_getInfoByName($name)
    {
        try {
            $res = self::join('login', 'login.id', 'login_id')
                ->where('register_name', '=', $name)
                ->select([
                    'register_name',
                    'register_email',
                    'register_phone',


                    'login.position_id',
                    'login.login_number',
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
     * 添加管理员的个人信息
     * @return false
     */
    public static function insertAdmin($id, $name, $email, $phone)
    {
        try {
            $res = self::join('student', 'student.id', 'student_id')
                ->where('id','=',$id)
                ->insert([

                    'register_name'  => $name,
                    'register_email' => $email,
                    'register_phone' => $phone,

                ]);

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }


}
