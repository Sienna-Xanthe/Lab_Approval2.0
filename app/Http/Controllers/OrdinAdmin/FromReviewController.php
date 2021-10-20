<?php

namespace App\Http\Controllers\OrdinAdmin;

use App\Http\Controllers\Controller;

use App\Http\Requests\OrdinAdmin\FormReviewRequest1;
use App\Http\Requests\OrdinAdmin\FormReviewRequest2;
use App\Http\Requests\OrdinAdmin\FormReviewRequest3;
use App\Models\FromReview;
use Illuminate\Http\Request;

class FromReviewController extends Controller
{


//    public function test(Request $request){
//        $id = auth('api')->user()->id; //获取login_id
        //        $login_number = auth('api')->user()->login_number;//获取工号
        //        $position_id = auth('api')->user()->position_id;//获取职位表id
        //        $account_id = auth('api')->user()->account_id//获取账号状态id    echo $id;}

    /**
     *管理员通过审批状态查与名称查看提交表单
     * @author zqz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
        public function zqz_state(Request $request)
        {
            $position_id = auth('api')->user()->position_id;//获取职位表id
            $form_name = $request['form_name_id'];
            $state=$request['state'];
            $res=FromReview::establishphoto($form_name,$position_id,$state);
            return $res ?
                json_success('查询成功!', $res, 200) :
                json_fail('查询失败!', null, 100);
        }





    /**
     * 管理员通过查询表单编号查看提交表
     * @author zqz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_submit(FormReviewRequest1 $request)
    {

        $position_id = auth('api')->user()->position_id;//获取职位表id
        $form_id = $request['form_id'];
        $res=FromReview::establishphoto5($position_id,$form_id);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }


    /**
     * 管理员查看表单详情
     * @author zqz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_details(FormReviewRequest2 $request)
    {
        $form_id = $request['form_id'];
        $form_name = $request['form_name_id'];
        $res=FromReview::establishphoto2($form_id,$form_name);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }


    /**
     * 管理员审批表单通过还是未通过
     * @author zqz
     * @param FormReviewRequest3 $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_adopt(FormReviewRequest3 $request)
    {
        $id = auth('api')->user()->id; //获取login_id
        $form_id     = $request['form_id'];
        $position_id = auth('api')->user()->position_id;//获取职位表id
        $form_reason = $request['form_reason'];
        $state       = $request['state'];
        $res=FromReview::establishphoto0($id,$form_id,$position_id,$form_reason,$state);
        return $res ?
            json_success('审批成功!', null, 200) :
            json_fail('审批失败!', null, 100);
    }


    /**
     * 管理员查看提交表单总数量
     * @author zqz
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_total(Request $request)
    {
        $position_id = auth('api')->user()->position_id;//获取职位表id
        $res=FromReview::establishphoto3($position_id);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }


    /**
     * 管理员查询表单中待审批，未通过，已通过的表单数量
     * @author zqz
     * @return \Illuminate\Http\JsonResponse
     */
    public function zqz_adoptTotal(Request $request)
    {
        $position_id = auth('api')->user()->position_id;//获取职位表id
        $res=FromReview::establishphoto4($position_id);
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

}
