<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public $table = 'list';
    protected $guarded = [];
    public $timestamps = true;
    /**
     * 得到所有职位的个人信息
     * @return false
     */
    public static function lyt_getEquipmentReturn()
    {
        try {
            $res = self::join('inventory', 'inventory.id', 'inventory_id')
//                ->join('equipment', 'equipment.id', 'equipment_id')
                ->select([
//                    'equipment.form_id',

                    'inventory.inventory_name',
                    'inventory.inventory_model',

                    'list.list_number',
                    'list.list_attachment',
                    'list.id'
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
     * 添加备注
     * @return false
     */
    public static function lyt_insertNote($id,$note)
    {
        try {
            $res = self::where('id','=',$id)
            ->update([
                'list_note'=>$note
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
     * 归还--更改状态
     * @return false
     */
    public static function lyt_updateReturnState($id,$equState)
    {
        try {
            $res = self::where('id','=',$id)
                ->update([
                    'list_state'=>$equState
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
