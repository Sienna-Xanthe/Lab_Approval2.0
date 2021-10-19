<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminList extends Model
{
    //list
    protected $table = "list";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     *  设备归还校验-名称型号下拉框
     */
    public static function yjx_inventoryNameModel($request){
        try {
            $step1=SuperAdminInventory::where('inventory_name',$request['inventory_name'])
                ->where('inventory_model',$request['inventory_model'])->value('id');

            $res=self::select('list.id','inventory_name','inventory_model','list_number',
                'list_attachment','list_returntime','list_note','list_state')
                  ->join('inventory','inventory.id','=','inventory_id')
                ->where('inventory_id',$step1)->get();

            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *  设备归还校验--表单编号查询
     */
    public static function yjx_inventoryId($request){
        try {
           $step1=$request['id'];
            $res=self::select('list.id','inventory_name','inventory_model','list_number',
                'list_attachment','list_returntime','list_note','list_state')
                ->join('inventory','inventory.id','=','inventory_id')
                ->where('list.id',$step1)
            ->get();
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *  设备归还校验--归还
     */
    public static function yjx_inventoryReturn($request){
        try {
            $step1=$request['id'];
            $num=self::where('id',$step1)->value('list_number'); //查找数量
            $step2=self::where('id',$step1)->value('inventory_id'); //查找id
            $step3=self::where('id',$step1)->update([
                'list_state'=>2
            ]);
            $step4=SuperAdminInventory::where('id',$step2)->value('inventory_inventory');//库存
            $step5=$step4+$num;

            $res=self::join('inventory','inventory.id','=','inventory_id')
                ->where('inventory_id',$step2)
                ->update([
                    'inventory_inventory'=>$step5
                ]);
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }




}
