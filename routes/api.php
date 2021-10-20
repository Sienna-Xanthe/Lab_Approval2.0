<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 登录注册模块
 */
Route::prefix('user')->group(function () {
    Route::post('login', 'Login\LoginController@login')->middleware('auth.rolecheck'); //登录
    Route::post('logout', 'Login\LoginController@logout'); //退出登录
    Route::post('registered', 'Login\LoginController@registered'); //注册
    Route::get('position','Login\LoginController@position');//职位显示
});//--pxy

/**
 * 学生负责人test
 */
Route::middleware('student.check')->prefix('test')->group(function (){
   Route::post('pxy','Login\LoginController@test');
});

/**
 * 普通管理员test
 */
Route::middleware('ordinadmin.check')->prefix('test11')->group(function (){//
    Route::post('admin','Login\LoginController@admin');

});

/**
 * 超级管理员test
 */
Route::middleware('superadmin.check')->prefix('test22')->group(function (){
    Route::post('superadmin','Login\LoginController@superadmin');

});
/**
 * test
 */
Route::prefix('ttt')->group(function (){
    Route::post('asd','Login\LoginController@asd')->middleware('refreshToken');
});

/**
 * 超管分配账号
 */
Route::prefix('superadmin')->group(function (){
Route::post('assignaccount','SuperAdmin\AssignController@assign');
});




/**
 * 普通管理员相应功能
 */
Route::prefix('admin')->group(function (){

    Route::post('add', 'OrdinAdmin\CheckController@zqz_add'); //添加期末教学记录检查
    Route::get('select', 'OrdinAdmin\CheckController@zqz_select'); //查询所有的期末教学记录检查

    Route::get('state', 'OrdinAdmin\FromReviewController@zqz_state'); //管理员通过表单名称与审批状态查提交表单
    Route::get('submit', 'OrdinAdmin\FromReviewController@zqz_submit'); //管理员通过查询编号查看提交表
    Route::get('details', 'OrdinAdmin\FromReviewController@zqz_details'); //管理员查看表单详情
    Route::post('adopt', 'OrdinAdmin\FromReviewController@zqz_adopt'); //管理员审批表单通过还是未通过
    Route::get('total', 'OrdinAdmin\FromReviewController@zqz_total'); //管理员查看提交表单总数量
    Route::get('adpttl', 'OrdinAdmin\FromReviewController@zqz_adoptTotal'); //管理员查询表单中待审批，未通过，已通过的表单数量
});//zqz


/**
 * 超级管理员中实验室管理部分
 */
Route::prefix('superadmin')->group(function (){

    Route::post('name', 'SuperAdmin\LabController@zqz_name'); //超级管理员通过实验名称查看所有实验室
    Route::post('add', 'SuperAdmin\LabController@zqz_add'); //超级管理员新增实验室
    Route::post('enable', 'SuperAdmin\LabController@zqz_enable'); //超级管理员新增实验室
}); //zqz

/***
 * 超级管理员模块
 */
Route::prefix('super')->group(function () {
    Route::get('getcounts','SuperAdmin\SuperAdminController@getState'); //表单数量统计-总数
    Route::get('queryform','SuperAdmin\SuperAdminController@queryFormAll');//表单管理-查看申请表-展示和下拉框的全部
    Route::get('formboxs','SuperAdmin\SuperAdminController@formComboBoxs');//表单管理-下拉框查询--名字和状态
    Route::get('formlook','SuperAdmin\SuperAdminController@formSearch');//表单管理-搜索框 表单编号
    Route::get('formlooka','SuperAdmin\SuperAdminController@formLookApply');//查看-申请表
    Route::post('termination','SuperAdmin\SuperAdminController@termination');//表单管理-终止功能
    Route::get('formexport','SuperAdmin\SuperAdminController@formExport');//表单管理-表单审批-导出
    Route::get('formsr','SuperAdmin\SuperAdminController@formShowRecord');//展示-记录表
    Route::get('inshow','SuperAdmin\SuperAdminController@inventoryShow');//设备管理-展示
    Route::get('inmodels','SuperAdmin\SuperAdminController@inventory_modelName');//设备管理-下拉框-型号
    Route::get('inids','SuperAdmin\SuperAdminController@inventory_idShow');//设备管理-搜索框-表单编号

    Route::post('inadd','SuperAdmin\SuperAdminController@inventory_add');//设备管理-新增
    Route::post('inupdate','SuperAdmin\SuperAdminController@inventory_update');//设备管理-修改
    Route::post('indelete','SuperAdmin\SuperAdminController@inventory_delete');//设备管理-删除
    Route::get('inname','SuperAdmin\SuperAdminController@inventory_nameModel');//设备归还校验-名称型号下拉框
    Route::get('inid','SuperAdmin\SuperAdminController@inventory_id');//设备归还校验-表单编号查询
    Route::post('inre','SuperAdmin\SuperAdminController@inventory_return');//设备归还校验-归还
});//yjx


/**
 * 表单管理操作
 */
Route::prefix('stu')->group(function (){
    Route::post('equipmentadd','StuAdmin\StuController@equipment_add');   //设备借用记录表添加
    Route::post('equipmentchange','StuAdmin\StuController@equipment_change');   //设备借用记录表添加
    Route::post('equipmentdelete','StuAdmin\StuController@equipment_delete');   //设备借用记录表撤销
    Route::get('equipmentlook','StuAdmin\StuController@equipment_look');   //设备借用记录表查询

    Route::post('borrowadd','StuAdmin\StuController@borrow_add');   //实验室借用表表添加
    Route::post('borrowchange','StuAdmin\StuController@borrow_change');   //实验室借用表添加
    Route::post('borrowdelete','StuAdmin\StuController@borrow_delete');   //实验室借用表撤销
    Route::get('borrowlook','StuAdmin\StuController@borrow_look');   //实验室借用表查询

    Route::post('openadd','StuAdmin\StuController@open_add');   //开放实验室借用表添加
    Route::post('openchange','StuAdmin\StuController@open_change');   //开放实验室借用表添加
    Route::post('opendelete','StuAdmin\StuController@open_delete');   //开放实验室借用表撤销
    Route::get('openlook','StuAdmin\StuController@open_look');   //开放实验室借用表查询

    Route::post('runadd','StuAdmin\StuController@run_add');   //实验室运行记录表添加
    Route::post('runlook','StuAdmin\StuController@run_look');   //实验室运行记录表查询

    Route::get('find','StuAdmin\StuController@find');   //实验室运行记录表添加
    Route::get('find1','StuAdmin\StuController@find1');   //实验室运行记录表查询
});//--wzh



