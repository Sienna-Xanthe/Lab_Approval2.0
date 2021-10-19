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
    Route::post('position','Login\LoginController@position');//职位显示
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
Route::middleware('ordinadmin.check')->prefix('test11')->group(function (){
    Route::post('admin','Login\LoginController@admin');
});

/**
 * 超级管理员test
 */
Route::middleware('superadmin.check')->prefix('test22')->group(function (){
    Route::post('superadmin','Login\LoginController@superadmin');
});
/***
 * 超级管理员模块
 */
Route::prefix('super')->group(function () {
    Route::get('getcount','SuperAdmin\SuperAdminController@getCount'); //表单数量统计-总数
    Route::get('getpending','SuperAdmin\SuperAdminController@getPending');//表单数量统计-待审批
    Route::get('getnot','SuperAdmin\SuperAdminController@getNotThrough');//表单数量统计未通过
    Route::get('getpass','SuperAdmin\SuperAdminController@getThrough'); //表单数量统计已通过
    Route::get('getting','SuperAdmin\SuperAdminController@getThroughing'); //表单数量统计审批中
    Route::get('queryform','SuperAdmin\SuperAdminController@queryFormAll');//表单管理-查看申请表-展示和下拉框的全部
    Route::get('formboxs','SuperAdmin\SuperAdminController@formComboBoxs');//表单管理-下拉框查询--名字和状态
   // Route::get('formboxf','SuperAdmin\SuperAdminController@formComboBoxf');//表单管理-下拉框查询-表单名称
    Route::get('formlook','SuperAdmin\SuperAdminController@formSearch');//表单管理-搜索框 表单编号
    Route::get('formlooka','SuperAdmin\SuperAdminController@formLookApply');//查看-申请表
    Route::post('termination','SuperAdmin\SuperAdminController@termination');//表单管理-终止功能
    Route::get('formexport','SuperAdmin\SuperAdminController@formExport');//表单管理-表单审批-导出
    Route::get('formsr','SuperAdmin\SuperAdminController@formShowRecord');//展示-记录表
    Route::get('inshow','SuperAdmin\SuperAdminController@inventoryShow');//设备管理-展示
    Route::get('inmodels','SuperAdmin\SuperAdminController@inventory_modelName');//设备管理-下拉框-名称
    Route::get('inids','SuperAdmin\SuperAdminController@inventory_idShow');//设备管理-搜索框-表单编号
    Route::post('inadd','SuperAdmin\SuperAdminController@inventory_add');//设备管理-新增
    Route::post('inupdate','SuperAdmin\SuperAdminController@inventory_update');//设备管理-修改
    Route::post('indelete','SuperAdmin\SuperAdminController@inventory_delete');//设备管理-删除
    Route::get('inname','SuperAdmin\SuperAdminController@inventory_nameModel');//设备归还校验-名称型号下拉框
    Route::get('inid','SuperAdmin\SuperAdminController@inventory_id');//设备归还校验-表单编号查询
    Route::post('inre','SuperAdmin\SuperAdminController@inventory_return');//设备归还校验-归还
});//yjx

