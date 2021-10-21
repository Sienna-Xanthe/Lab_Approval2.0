<?php


namespace App\Http\Controllers\StuAdmin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StuAdmin\addNoteRequest;
use App\Http\Requests\StuAdmin\showEquipmentReturnRequest;
use App\Models\Equipment;

class EquipmentReturnController extends Controller
{
    /**
     * 学生端显示设备归还情况
     * @param  showEquipmentReturnRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showEquipmentReturn(showEquipmentReturnRequest $request)
    {
        $res = Equipment::lyt_getEquipmentReturn();

        return $res ?
            json_success('显示设备成功!', $res, 200) :
            json_fail('显示设备失败!', null, 100);

    }

    /**
     * 添加备注
     * @param  addNoteRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNote(addNoteRequest $request)
    {
        $note = $request['note'];
        $id = $request['id'];
        Equipment::lyt_insertNote($id,$note);
        $equState=1;
        $res=Equipment::lyt_updateReturnState($id, $equState);
        return $res ?
            json_success('更改归还状态成功!', $res, 200) :
            json_fail('更改归还状态失败!', null, 100);
    }

//    /**
//     * 更改归还状态
//     * @param  changeReturnRequest $request  $request
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function changeReturn(changeReturnRequest $request)
//    {
//        $id = $request['id'];
//        $equState=1;
//        $res=Equipment::lyt_updateReturnState($id, $equState);
//        return $res ?
//            json_success('更改归还状态成功!', $res, 200) :
//            json_fail('更改归还状态失败!', null, 100);
//
//    }


}
