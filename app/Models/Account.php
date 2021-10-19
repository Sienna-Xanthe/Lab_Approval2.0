<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $table = 'account';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * 更新管理员状态
     * @param $id
     * @param $newPassword
     * @return false
     */
    public static function lyt_updateAdminState($accountId, $sta)
    {
        try {
            $res = self::where([
                'id' => $accountId,
            ])
                ->update([
                    'account_state2' => $sta
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
     * 更新管理员状态
     * @param $id
     * @param $newPassword
     * @return false
     */
    public static function lyt_updateAdminState2($aid, $stateId)
    {
        try {
            $res = self::where([
                'id' => $aid,
            ])
                ->update([
                    'account_state1' => $stateId
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
     * 更新管理员状态
     * @param $id
     * @param $newPassword
     * @return false
     */
    public static function lyt_addAdminState2($aid)
    {
        try {
            $res = self::update([
                    'account_state1' => $aid
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
