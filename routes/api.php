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
