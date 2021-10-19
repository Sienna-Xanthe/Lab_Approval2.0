<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class SuperAdminInventory extends Model
{
    //inventory
    protected $table = "inventory";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * 设备管理
     * 展示
     */
    public static function yjx_inventoryShow(){
        try {
            $res=self::select("id","inventory_name","inventory_model",
                'inventory_sum','inventory_inventory')->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理-下拉框-型号
     */
    public static function yjx_modelShow($request){
        try {
            $res=self::select("id","inventory_name","inventory_model",
                'inventory_sum','inventory_inventory','inventory_attachment')
                ->where('inventory_name',$request['inventory_name'])->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理-搜索框-id
     */
    public static function yjx_idShow($request){
        try {
            $res=self::select("id","inventory_name","inventory_model",
                'inventory_sum','inventory_inventory','inventory_attachment')
                ->where('id',$request['id'])->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理-新增
     */
    public static function yjx_inventoryAdd($request){
        try {
            $step=self::where('inventory_name',$request['inventory_name'])
                ->where( 'inventory_model',$request['inventory_model'])->count();
            if ($step==0){
                $res=self::create([
                    "inventory_name"=>$request['inventory_name'],
                    'inventory_model'=>$request['inventory_model'],
                    'inventory_sum'=>$request['inventory_sum'],
                    'inventory_inventory'=>$request['inventory_sum'],
                    'inventory_attachment'=>$request['inventory_attachment']
                ]);
                return $res?
                    $res :
                    false;
            }else{
              return 0;
            }


        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理-修改
     */
    public static function yjx_inventoryUpdate($request){
        try {
            $res=self::where('id',$request['id'])
                ->update([
                'inventory_sum'=>$request['inventory_sum'],
            ]);
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理-删除
     */
    public static function yjx_inventoryDelete($request){
        try {
            $res=self::where('id',$request['id'])->delete();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}
